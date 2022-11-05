<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

$headers = [
    'Access-Control-Allow-Origin'      => '*',
    'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
    'Access-Control-Allow-Credentials' => 'true',
    'Access-Control-Max-Age'           => '86400',
    'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
];

// remove version of php
header_remove('x-powered-by');

if ($config['CORS']) {
    if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
        http_response_code(200);
    }

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        if (count($config['ALLOWED_ORIGINS'])) {
            if (!in_array($_SERVER['HTTP_ORIGIN'], $config['ALLOWED_ORIGINS'])) {
                http_response_code(403);
                exit();
            }
        }
    }

    foreach ($headers as $key => $value) {
        header($key . ': ' . $value);
    }
}
