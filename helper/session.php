<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

if (!function_exists("create_session")) {
    function create_session($data)
    {
        global $config;
        if (!isset($config['SESSION_NAME'])) {
            die('$config[SESSION_NAME] tidak ditemukan');
        }

        $session_name = $config['SESSION_NAME'];

        if (session_id() == '') {
            session_start();
        }

        $_SESSION[$session_name] = $data;
    }
}

if (!function_exists("session_validate")) {
    function session_validate()
    {
        global $config;
        if (!isset($config['SESSION_NAME'])) {
            die('$config[SESSION_NAME] tidak ditemukan');
        }

        $session_name = $config['SESSION_NAME'];

        if (session_id() == '') {
            session_start();
        }

        if (!isset($_SESSION[$session_name])) {
            return false;
        }
        return true;
    }
}

if (!function_exists("delete_session")) {
    function delete_session()
    {
        global $config;
        if (!isset($config['SESSION_NAME'])) {
            die('$config[SESSION_NAME] tidak ditemukan');
        }

        $session_name = $config['SESSION_NAME'];

        if (session_id() == '') {
            session_start();
        }

        // unset($_SESSION[$session_name]);
        session_destroy();
    }
}

if (!function_exists("get_session")) {
    function get_session()
    {
        global $config;
        if (!isset($config['SESSION_NAME'])) {
            die('$config[SESSION_NAME] tidak ditemukan');
        }

        $session_name = $config['SESSION_NAME'];

        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION[$session_name])) {
            return $_SESSION[$session_name];
        } else {
            return null;
        }
    }
}

if (!function_exists("flash_session")) {
    function flash_session($name, $data = null)
    {
        $session_name = $name;

        if (session_id() == '') {
            session_start();
        }
        if (isset($data)) {
            $_SESSION[$session_name] = $data;
        } else {
            if (isset($_SESSION[$name])) {
                $data =  $_SESSION[$name];
                unset($_SESSION[$name]);
                return $data;
            } else {
                return null;
            }
        }
    }
}
