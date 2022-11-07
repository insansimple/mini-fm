<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists('if_post')) {
    function if_post($params)
    {
        $arr_params = [];

        if (!is_array($params)) {
            $arr_params[] = $params;
        } else {
            $arr_params = $params;
        }

        foreach ($arr_params as $param) {
            if (!isset($_POST[$param])) {
                return false;
            } elseif ($_POST[$param] === "") {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('if_get')) {
    function if_get($params)
    {
        $arr_params = [];

        if (!is_array($params)) {
            $arr_params[] = $params;
        } else {
            $arr_params = $params;
        }

        foreach ($arr_params as $param) {
            if (!isset($_GET[$param])) {
                return false;
            } elseif ($_GET[$param] === "") {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('if_content')) {
    function if_content($params, $content)
    {
        $arr_params = [];

        if (!is_array($params)) {
            $arr_params[] = $params;
        } else {
            $arr_params = $params;
        }

        foreach ($arr_params as $param) {
            if (!isset($content[$param])) {
                return false;
            }
        }

        return true;
    }
}
if (!function_exists('get_content')) {
    function get_content()
    {
        $res = json_decode(file_get_contents('php://input'), true);
        return $res;
    }
}

if (!function_exists('final_response')) {
    function final_response($msg, $data = null,  $err = 0)
    {
        $response = [
            'error' => $err,
            'msg'   => $msg,
            'data'  => $data
        ];

        echo json_encode($response);
        exit();
    }
}

if (!function_exists('response')) {
    function response($msg, $data = null, $err = 0)
    {
        $response = [
            'error' => $err,
            'msg'   => $msg,
            'data'  => $data
        ];

        echo json_encode($response);
    }
}
