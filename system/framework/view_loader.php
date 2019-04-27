<?php

use Exceptions\ViewNotFoundException;

function load_view($filename, $data = [])
{
    if (is_readable("./views/{$filename}.php")) {
        
        extract($data);
        
        ob_start();
        
        include "./views/{$filename}.php";
        
        return ob_get_clean();
    } else
        throw new ViewNotFoundException($filename);
}

function load_global_view($filename, $data = [])
{
    if (is_readable(__DIR__ . "/../views/{$filename}.php")) {
        
        extract($data);
        
        ob_start();
        
        include __DIR__ . "/../views/{$filename}.php";
        
        return ob_get_clean();
    } else
        throw new ViewNotFoundException($filename);
}
    