<?php

defined('BASEPATH') or exit('Akses langsung tidak diizinkan!');

// untuk API
add_route('/', 'default.php', 'get');
add_route('/page1', function () {
    print_r($_GET);
    echo "Hello Page1</br>";
    echo url("/page1/page2");
    echo "</br>";
    print_r(is_request_uri('/page1'));
});
