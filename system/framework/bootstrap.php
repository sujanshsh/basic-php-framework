<?php

// use Url to define adaptive path constants
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
    $global_protocol = 'https';
else
    $global_protocol = 'http';

$global_port = $_SERVER['SERVER_PORT'];

if ($global_port != '80') {
    $global_port_str = ':' . $global_port;
} else {
    $global_port_str = '';
}

define('SITE_PROTOCOL', $global_protocol);

unset($global_protocol);

define('SITE_NAME', $_SERVER['HTTP_HOST']);

$request_uri = str_replace($_SERVER['PATH_INFO'], '', $_SERVER['REQUEST_URI']);

define('SITE_URL', $request_uri);

$base_url_temp = preg_replace('/\/[^\/]+\.php$/', '', $request_uri);

define('BASE_URL', rtrim($base_url_temp, '/'));

require __DIR__.'/custom_error_handler.php';

if(is_readable(__DIR__.'/../../vendor/autoload.php'))
    include __DIR__.'/../../vendor/autoload.php';

require __DIR__.'/autoloader.php';

require __DIR__.'/view_loader.php';

$singleton_config = require __DIR__.'/../config/singleton.php';

require __DIR__.'/App.php';

$_framework_app = new App();

$_framework_app->setSingletons($singleton_config);

function app() {
    global $_framework_app;
    return $_framework_app;
}
