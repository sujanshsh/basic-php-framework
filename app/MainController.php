<?php

namespace app;

/**
 * @author Sujan Shakya
 */
class MainController
{

    private $title = 'Application';
    
    private $body = '';
    
    public function __construct()
    {
    }

    public function index()
    {
        $this->body = load_view('main');
        $this->output();
    }
    
    private function output()
    {
        echo load_global_view('main_template',[
            'title' => $this->title,
            'body' => $this->body,
        ]);  
    }
}