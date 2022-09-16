<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists('get_config')) {
    function get_config($item)
    {
        global $config;
        return $config[$item];
    }
}

if(!function_exists("load_view")){
    function load_view($module, $params, $return = false){
        ob_start();
            foreach($params as $key=>$value){
                ${$key} = $value;
            }
            include fix_separator(get_config('MODULES_DIR'), $module);
            $res = ob_get_contents();
        ob_end_clean();
        
        if($return){
            return $res;
        }

        echo $res;
    }
}

if(!function_exists("app_name")){
    function app_name(){
        global $config;
        return $config["APP_NAME"];
    }
}

if(!function_exists("asset")){
    function asset($path){
        global $config;
        if(substr($config['URL'], -1, 1) !== "/"){
            $part1 = $config['URL']."/";
        }else{
            $part1 = $config['URL'];
        }

        if(isset($path)){
            if(substr($path, 0, 1) === "/"){
                $part2 = substr($path, 1);
            }else{
                $part2 = $path;
            }
        }else{
            $part2 = "";
        }

        return $part1.$config['ASSETS_DIR'].'/'.$part2;
    }
}

if(!function_exists("url")){
    function url($path=null){
        global $config;
        if(substr($config['URL'], -1, 1) !== "/"){
            $part1 = $config['URL']."/";
        }else{
            $part1 = $config['URL'];
        }

        if(isset($path)){
            if(substr($path, 0, 1) === "/"){
                $part2 = substr($path, 1);
            }else{
                $part2 = $path;
            }
        }else{
            $part2 = "";
        }

        return $part1.$part2;
    }
}