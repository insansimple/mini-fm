<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists("fix_separator")) {
    function fix_separator($paths)
    {
        $path = join(DIRECTORY_SEPARATOR, $paths);
        $path = str_replace("/", DIRECTORY_SEPARATOR, $path);
        $path = str_replace(str_repeat(DIRECTORY_SEPARATOR, 2), DIRECTORY_SEPARATOR, $path);
        return $path;
    }
}

foreach ($config['HELPER'] as $helper) {
    require_once fix_separator([$config['HELPER_DIR'], $helper]);
}
