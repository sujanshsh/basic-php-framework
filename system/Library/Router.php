<?php

namespace Library;

use Exceptions\MethodNotExistsException;

class Router
{
    
    private static $route_found = FALSE;

    public static function on($request_method, $url, $controller_class, $method = 'index')
    {
        
        if(self::$route_found)
            return;

        if($_SERVER['REQUEST_METHOD'] != strtoupper($request_method))
            return;

         $url = str_replace('\\', '/', rtrim(ltrim($url, '/') ,'/'));
             
         $url_explode = explode('/', $url);
         
         $request_explode = explode('/', rtrim(ltrim($_SERVER['PATH_INFO'], '/') ,'/'));
         
         $params = [];

         foreach($request_explode as $i => $segment) {
             if($url_explode[$i] != $segment) {
                 if(preg_match('/^\{.*\}$/',$url_explode[$i])) {
                     $params[] = $segment;
                 } else {
                     return;
                 }
             }
         }
         
         $controller = new $controller_class();
         
         if(method_exists($controller, $method)) {
             call_user_func_array(array($controller, $method), $params);
             self::$route_found = TRUE;
         } else {
             throw new MethodNotExistsException($controller_class,$method);
         }
    }
    
}