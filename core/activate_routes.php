<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

$path_info = $_SERVER['PATH_INFO'] ?? "/";

if (!isset($ROUTES[$path_info])) {
    include fix_separator('error', '404.php');
} else {
    $method = strtoupper($ROUTES[$path_info]['method']);

    if($_SERVER['REQUEST_METHOD'] != "OPTIONS"){
        if($_SERVER['REQUEST_METHOD'] != $method){
            http_response_code(405);
            // echo "method salah!";
            exit();
        }
    }
    
    $module = $ROUTES[$path_info]['module'];

    ob_start();
    include fix_separator($config['MODULES_DIR'],$module);
    $content = ob_get_contents();
    ob_end_clean();
    echo $content;
}