<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

$path_info = isset($_SERVER['PATH_INFO']) ? remove_end_bs($_SERVER['PATH_INFO']) : "/";

if (!isset($ROUTES[$path_info])) {
    include fix_separator('error', '404.php');
} else {
    // jika metod request lebih dari satu
    if (is_array($ROUTES[$path_info]['method'])) {
        $arr_method = $ROUTES[$path_info]['method'];
        $method_server = strtolower($_SERVER['REQUEST_METHOD']);
        if (!in_array($method_server, $arr_method)) {
            http_response_code(405);
            exit();
        }
        // hanya untuk single method request
    } else {
        $method = strtoupper($ROUTES[$path_info]['method']);
        if ($_SERVER['REQUEST_METHOD'] != "OPTIONS") {
            if ($_SERVER['REQUEST_METHOD'] != $method) {
                http_response_code(405);
                // echo "method salah!";
                exit();
            }
        }
    }

    $module_or_callable = $ROUTES[$path_info]['module'];

    if (is_callable($module_or_callable)) {
        call_user_func($module_or_callable);
    } else {
        ob_start();
        include fix_separator($config['MODULES_DIR'], $module_or_callable);
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}
