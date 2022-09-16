<?php

$system_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'system';

define('BASEPATH', $system_path);

date_default_timezone_set('Asia/Jakarta');

require './config/config.php';
require $config['SYSTEM_DIR'].DIRECTORY_SEPARATOR.'cors.php';
// require './vendor/autoload.php';
require $config['SYSTEM_DIR'].DIRECTORY_SEPARATOR.'autoload.php';
require $config['SYSTEM_DIR'].DIRECTORY_SEPARATOR.'system_funcs.php';
require $config['SYSTEM_DIR'].DIRECTORY_SEPARATOR.'routes_engine.php';
require $config['ROUTE_DIR'].DIRECTORY_SEPARATOR.'web.php';
require $config['SYSTEM_DIR'].DIRECTORY_SEPARATOR.'activate_routes.php';