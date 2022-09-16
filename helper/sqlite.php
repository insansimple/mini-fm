<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if(!function_exists("disk_path")){
    function disk_path($db_name = ""){
        return get_config('STORAGE_DIR').'/db/'.$db_name;
    }
}

if(!function_exists('create_db')){
    function create_db($db_name){
        if(!file_exists(disk_path($db_name))){
            touch(disk_path($db_name));
        }
    }
}

if(!function_exists('create_table')){
    function create_table($db_name){
        $file = disk_path($db_name);
        $db = new SQLite3($file);
        $db->exec("CREATE TABLE `data_form`(
                    `data_id` INTEGER PRIMARY KEY AUTOINCREMENT,
                    `user_id` INTEGER NULL,
                    `nama` INTEGER NULL,
                    `test` INTEGER NOT NULL DEFAULT '0',
                    `raw_json` TEXT NOT NULL,
                    `dt` DATETIME DEFAULT (datetime('now','localtime')))");
    }
}

if(!function_exists('save_item')){
    function save_item($db_name, $raw_json){
        $file = disk_path($db_name);
        $db = new SQLite3($file);
        $stmt = $db->prepare("INSERT INTO `data_form`(data_id, raw_json) VALUES(:data_id, :raw_json) ON CONFLICT(data_id) DO UPDATE SET raw_json = :raw_json");
        $stmt->bindValue(':data_id', 1, SQLITE3_INTEGER);
        $stmt->bindValue(':raw_json', $raw_json);
        $stmt->execute();
    }
}

if(!function_exists('insert_data')){
    function insert_data($db_name, $raw_json){
        $file = disk_path($db_name);
        $db = new SQLite3($file);
        $stmt = $db->prepare("INSERT INTO `data_form`(raw_json) VALUES(:raw_json)");
        $stmt->bindValue(':raw_json', $raw_json);
        return $stmt->execute();
    }
}

if(!function_exists('add_unused')){
    function add_unused($db_name){
        $text = $db_name . " " . date("Y-m-d h:i:s");
        $myfile = file_put_contents(disk_path('unused.txt'), $text.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}