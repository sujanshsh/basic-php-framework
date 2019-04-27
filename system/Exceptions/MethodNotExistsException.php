<?php

namespace Exceptions;

/**
 * @author Sujan Shakya
 */
class MethodNotExistsException extends \Exception
{
    
    private $class_name;
    
    private $method_name;
    
    public function __construct($class_name, $method_name) {
        parent::__construct();
        $this->class_name = $class_name;
        $this->method_name = $method_name;
    }
    
    public function __toString()
    {
        return '<p style="color: red;">Method Does Not Exists</p>'
            . '<pre style="font-size: 11px; font-family: consolas;">'
            . "Class $this->class_name does not have any method named {$this->method_name}."
            . '</pre>';
    }
    
}