<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists("disk_path")) {
    function disk_path($db_name = "")
    {
        return fix_separator([get_config('SQLITE_DIR'), $db_name]);
    }
}

if (!function_exists('sqlite_check_db_file')) {
    function sqlite_check_db_file($db_name)
    {
        if (!file_exists(disk_path($db_name))) {
            return 0;
        } else {
            return 1;
        }
    }
}

if (!function_exists('sqlite_select_distinct')) {
    function sqlite_select_distinct($db_name, $tbl_name, $col)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $query  = "SELECT DISTINCT `$col` FROM $tbl_name";
        $result = $db->query($query);
        while ($row = $result->fetchArray()) {
            $rows[] = $row[0];
        }
        return $rows;
    }
}

if (!function_exists('sqlite_check_table')) {
    function sqlite_check_table($db_name, $tbl_name)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $query  = "SELECT COUNT(*) as `count` FROM sqlite_master WHERE type='table' AND name='$tbl_name'";
        $result = $db->query($query);
        $row    = $result->fetchArray();
        return $row['count'];
    }
}

if (!function_exists('sqlite_get_count')) {
    function sqlite_get_count($db_name, $tbl_name)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $query  = "SELECT COUNT(*) as `count` FROM '$tbl_name'";
        $result = $db->query($query);
        $row    = $result->fetchArray();
        return $row['count'];
    }
}

if (!function_exists('sqlite_create_db')) {
    function sqlite_create_db($db_name)
    {
        $db_file = disk_path($db_name);
        if (!file_exists($db_file)) {
            touch($db_file);
            chmod($db_file, 0777);
        }
    }
}

if (!function_exists('sqlite_create_table')) {
    function sqlite_create_table($fields, $db_name, $table_name = "master_data")
    {
        sqlite_create_db($db_name);

        if (!isset($fields)) {
            die('Array tidak valid');
        }

        if (count($fields) == 0) {
            die('Array tidak ada!');
        }

        $file   = disk_path($db_name);
        $db     = new SQLite3($file);

        $query  = "DROP TABLE IF EXISTS " . $table_name;
        $res = $db->exec($query);

        $str1 = sprintf("CREATE TABLE %s ", $table_name);

        $arr_field[] = "`data_id` INTEGER PRIMARY KEY AUTOINCREMENT";
        foreach ($fields as $field) {
            $arr_field[] = sprintf("`%s` TEXT NULL", $field);
        }

        $str2   = "(" . join(",", $arr_field) . ")";
        $query  = $str1 . $str2;
        $res    = $db->exec($query);
        if (!$res) {
            return $db->lastErrorMsg();
        } else {
            return null;
        }
    }
}

if (!function_exists('fix_single_quote')) {
    function fix_single_quote($str)
    {
        if (!strpos($str, "''")) {
            return str_replace("'", "''", $str);
        } else {
            return $str;
        }
    }
}
if (!function_exists('sqlite_push_data')) {
    function sqlite_push_data($db_name, $table_name, $data, $fields)
    {
        $new_values = [];
        foreach ($data as $item) {
            $new_item = [];
            for ($i = 1; $i <= count($fields); $i++) {
                $new_item[] = isset($item[$i]) ? "'" . fix_single_quote($item[$i]) . "'" : "''";
            }
            $new_values[] = "(" . join(",", $new_item) . ")";
        }

        $str_values = join(",", $new_values);
        $str_fields = "`" . join("`,`", $fields) . "`";

        $query = "INSERT INTO $table_name($str_fields) VALUES $str_values";
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $res = $db->exec($query);
        if (!$res) {
            return $db->lastErrorMsg();
        } else {
            return null;
        }
    }
}

if (!function_exists("sqlite_read_columns")) {
    function sqlite_read_columns($db_name, $table_name)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $query  = sprintf("SELECT `name` FROM pragma_table_info('%s');", $table_name);
        $result = $db->query($query);
        while ($row = $result->fetchArray()) {
            $columns[] = $row[0];
        }

        // vardump($columns);
        return $columns ? $columns : null;
    }
}

if (!function_exists("sqlite_read_data")) {
    function sqlite_read_data($db_name, $table_name)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $query  = sprintf("SELECT * FROM '%s';", $table_name);
        $result = $db->query($query);

        if (!$result) {
            die("Error (" . $db->lastErrorCode() . ") : " . $db->lastErrorMsg());
        }
        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $data[] = $row;
        }

        // vardump($data);
        return $data ? $data : null;
    }
}

if (!function_exists("sqlite_read_data_where")) {
    function sqlite_read_data_where($db_name, $table_name, $filter)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        if ($filter) {
            $filter_field = $filter['filter'];
            $value = $filter['value'];
            foreach ($filter_field as $key => $val) {
                $arr_where[] = "`$val`='" . fix_single_quote($value[$key]) . "'";
            }

            if ($arr_where) {
                $str_where = join(" AND ", $arr_where);
            }

            if ($str_where) {
                $str_where = " WHERE " . $str_where;
            } else {
                $str_where = "";
            }
        } else {
            $str_where = "";
        }

        $query  = sprintf("SELECT * FROM '%s'%s;", $table_name, $str_where);
        $result = $db->query($query);

        if (!$result) {
            die("Error (" . $db->lastErrorCode() . ") : " . $db->lastErrorMsg());
        }
        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $data[] = $row;
        }

        // vardump($data);
        return $data ? $data : null;
    }
}

if (!function_exists("sqlite_read_stats_where")) {
    function sqlite_read_stats_where($db_name, $table_name, $field, $filter)
    {
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        if ($filter) {
            $filter_field = $filter['filter'];
            $value = $filter['value'];
            foreach ($filter_field as $key => $val) {
                $arr_where[] = "`$val`='" . fix_single_quote($value[$key]) . "'";
            }

            if ($arr_where) {
                $str_where = join(" AND ", $arr_where);
            }

            if ($str_where) {
                $str_where = " WHERE " . $str_where;
            } else {
                $str_where = "";
            }
        } else {
            $str_where = "";
        }

        $query  = "SELECT `$field` as `data`, COUNT(data_id) as `jumlah` FROM $table_name $str_where GROUP BY `$field` ORDER BY COUNT(data_id) DESC";
        $result = $db->query($query);

        if (!$result) {
            die("Error (" . $db->lastErrorCode() . ") : " . $db->lastErrorMsg());
        }

        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $data[] = $row;
        }

        // vardump($data);
        return $data ? $data : null;
    }
}

if (!function_exists("update_data")) {
    function update_data($db_name, $table_name, $field_values, $where)
    {
        if (!count($field_values)) {
            return "Fields and Values different size";
        }

        foreach ($field_values as $field => $value) {
            $array_fields[] = "`$field` = '$value'";
        }

        foreach ($where as $key => $value) {
            $str_where = "WHERE `$key` = '$value";
        }

        $str_fields_update = join(",", $array_fields);

        $query = "UPDATE $table_name SET $str_fields_update $str_where";
        vardump($query);
        $file   = disk_path($db_name);
        $db     = new SQLite3($file);
        $res = $db->exec($query);
        if (!$res) {
            return $db->lastErrorMsg();
        } else {
            return null;
        }
    }
}
