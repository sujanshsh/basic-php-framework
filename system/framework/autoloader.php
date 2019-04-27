<?php

$framework_autoloader = function ($name) {
    
    require __DIR__ . '/../config/autoloader.php';
    
    $autoload_path_global = __DIR__.'/../'; // i.e. system/
    
    $autoload_path_module = __DIR__.'/../../'; // document root
    
    $name = str_replace('\\', '/', $name);
    
    $exploded = explode('/', $name);
    
    if (isset($special_namespaces[$exploded[0]])) {
        $autoload_path_special = $special_namespaces[$exploded[0]];
    } else {
        $autoload_path_special = '';
    }
    
    $autoload_path_append = in_array($name, $fake_classes) ? 'fake/' : '';
    
    $autoload_path = $autoload_path_special ? $autoload_path_special : '';
    
    if(!$autoload_path) {
        if(is_readable($autoload_path_global . $autoload_path_append . $name . '.php'))
            $autoload_path = $autoload_path_global;
        else 
            $autoload_path = $autoload_path_module;
    }
    
    require_once ($autoload_path . $autoload_path_append . $name . '.php');
};

try {
    spl_autoload_register($framework_autoloader,/*throw exception on failure*/TRUE,/*prepend*/FALSE);
} catch (Exception $ex) {
    die('Application files could not be loaded');
}