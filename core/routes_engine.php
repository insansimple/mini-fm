<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

$ROUTES = [];

function add_route($path, $module, $method = "GET")
{
    global $ROUTES;
    if (substr($path, 0, 1) != "/") {
        $ROUTES[strtolower('/' . $path)] = ["path" => $path, "module" => $module, "method" => $method];
    } else {
        $ROUTES[strtolower($path)] = ["path" => $path, "module" => $module, "method" => $method];
    }
}

function redirect($path)
{
    header('Location: ' . url($path));
    exit();
}

function is_request_uri($href)
{
    $request_uri = $_SERVER['PATH_INFO'] ? $_SERVER['PATH_INFO'] : "/";
    $request_uri = substr($request_uri, 0, strlen($href));
    if ($href == $request_uri) {
        return true;
    }
    return false;
}
