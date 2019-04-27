<?php

namespace app;

use Library\Router;

require __DIR__ . '/../system/framework/bootstrap.php';


try {
    
    Router::on('get', '/', MainController::class);
    Router::on('get', '/example/{name}', AjaxController::class, 'example');
} catch(\Exception $ex) {
    
    echo load_global_view('main_template',[
            'title' => 'Application - Error Occured',
            'body' => $ex
        ]); 
}