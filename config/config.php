<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

// variabel umum
$config['URL']          = 'http://localhost:8000/';
$config['APP_NAME']     = 'LMS Mate-21';
$config['VERSI']        = '1.0';
$config['DB_SERVER']    = 'localhost';
$config['DB_USER']      = '';
$config['DB_PASSWORD']  = '';
$config['DB_NAME']      = '';
$config['ASSETS_DIR']   = 'assets';
$config['HELPER_DIR']   = 'helper';
$config['MODULES_DIR']  = 'modules';
$config['STORAGE_DIR']  = 'upload';
$config['ROUTE_DIR']    = 'routes';
$config['SYSTEM_DIR']   = 'core';
$config['SESSION_NAME'] = 'simple_session';
$config['REDIRECT_PATH'] = '';

// configruasi cors (Cross-origin resource sharing)
// nilai bisa true/false
$config['CORS']         = false;

// nilai adalah string array, alamat website yang diizinkan mengakses cors, kosong bila izinkan semua
$config['ALLOWED_ORIGINS'] = [];

// string array misalnya ['koneksi.php','request.php'];
$config['HELPER']       = [];
