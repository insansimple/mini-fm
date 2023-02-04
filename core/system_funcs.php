<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

//remove end backslash mark
if (!function_exists("remove_end_bs")) {
    function remove_end_bs($path)
    {
        $new_path = $path;

        if (substr($path, -1) === "/") {
            $new_path = substr($path, 0, -1);
        }

        return $new_path;
    }
}

if (!function_exists('get_config')) {
    function get_config($item)
    {
        global $config;
        return $config[$item];
    }
}

if (!function_exists("load_view")) {
    function load_view($module, $params = null, $return = false)
    {
        ob_start();
        if ($params) {
            foreach ($params as $key => $value) {
                ${$key} = $value;
            }
        }
        include fix_separator([get_config('MODULES_DIR'), $module]);
        $res = ob_get_contents();
        ob_end_clean();

        if ($return) {
            return $res;
        }

        echo $res;
    }
}

if (!function_exists("load_helper")) {
    function load_helper($helper)
    {
        ob_start();
        include fix_separator([get_config('HELPER_DIR'), $helper]);
        $res = ob_get_contents();
        ob_end_clean();

        echo $res;
    }
}

if (!function_exists("load_library")) {
    function load_library($library)
    {
        ob_start();
        include fix_separator([get_config('LIBRARIES_DIR'), $library]);
        $res = ob_get_contents();
        ob_end_clean();

        echo $res;
    }
}

if (!function_exists("app_name")) {
    function app_name()
    {
        global $config;
        return $config["APP_NAME"];
    }
}

if (!function_exists("asset")) {
    function asset($path)
    {
        global $config;
        if (substr($config['URL'], -1, 1) !== "/") {
            $part1 = $config['URL'] . "/";
        } else {
            $part1 = $config['URL'];
        }

        if (isset($path)) {
            if (substr($path, 0, 1) === "/") {
                $part2 = substr($path, 1);
            } else {
                $part2 = $path;
            }
        } else {
            $part2 = "";
        }

        return $part1 . $config['ASSETS_DIR'] . '/' . $part2;
    }
}

if (!function_exists("url")) {
    function url($path = null)
    {
        global $config;
        if (substr($config['URL'], -1, 1) !== "/") {
            $part1 = $config['URL'] . "/";
        } else {
            $part1 = $config['URL'];
        }

        if (isset($path)) {
            if (substr($path, 0, 1) === "/") {
                $part2 = substr($path, 1);
            } else {
                $part2 = $path;
            }
        } else {
            $part2 = "";
        }

        return $part1 . $part2;
    }
}

if (!function_exists("vardump")) {
    function vardump($identifier)
    {
        echo "<pre>";
        print_r($identifier);
        exit();
    }
}
