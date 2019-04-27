<?php

namespace Exceptions;

class SqlParseErrorException extends \Exception
{
    
    private $error_array;
    
    public function __construct($error_array) {
        parent::__construct();
        $this->error_array = $error_array;
    }
    
    public function __toString()
    {
        return '<p style="color: red;">SQL Parse Error</p>'
            . '<pre style="font-size: 11px; font-family: consolas;">'
            . print_r($this->error_array, TRUE)
            . '</pre>';
    }

}