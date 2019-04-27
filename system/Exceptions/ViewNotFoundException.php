<?php

namespace Exceptions;

/**
 * @author Sujan Shakya
 */
class ViewNotFoundException extends \Exception
{
    
    private $view;
    
    public function __construct($view) {
        parent::__construct();
        $this->view = $view;
    }
    
    public function __toString()
    {
        return "View '$this->view' does not exists.";
    }
}