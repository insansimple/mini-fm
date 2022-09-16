<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

load_view("view_hello.php", [
    'header'    => "Selamat Datang di Mini FM", 
    'text'      => "Ini adalah framework mini yang dibuat untuk memenuhi kebutuhan website skala kecil atau website API yang dilengkapi dengan fitur CORS"
    ], 
false);