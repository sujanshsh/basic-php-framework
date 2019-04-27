<?php

namespace Exceptions;

/**
 * @author Sujan Shakya
 */

class SqlExecutionErrorException extends \Exception
{
    
    private $error_array;
    
    public function __construct($error_array) {
        parent::__construct();
        $this->error_array = $error_array;
    }
    
    public function __toString()
    {
        return '<p style="color: red;">SQL Execution Error</p>'
            . '<pre style="font-size: 11px; font-family: consolas;">'
            . print_r($this->error_array, TRUE)
            . '</pre>';
    }
}