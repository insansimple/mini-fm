<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if(!function_exists("print_server")){
    function print_server(){
        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";
    }
}