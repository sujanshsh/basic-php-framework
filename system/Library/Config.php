<?php

namespace Library;

class Config
{
    
    public static function get($class_name)
    {
        return require __DIR__ . '/../config/' . strtolower($class_name) . '.php';    
    }
    
}