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

if (!function_exists("fix_separator")) {
    function fix_separator(...$paths)
    {
        $path = join(DIRECTORY_SEPARATOR, $paths);
        $path = str_replace("/", DIRECTORY_SEPARATOR, $path);
        $path = str_replace(str_repeat(DIRECTORY_SEPARATOR, 2), DIRECTORY_SEPARATOR, $path);
        return $path;
    }
}

foreach ($config['HELPER'] as $helper) {
    require_once fix_separator($config['HELPER_DIR'], $helper);
}
