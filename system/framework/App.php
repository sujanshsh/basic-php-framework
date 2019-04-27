<?php

class App
{
    
    private $singletons = [];
    
    private $singleton_params = [];
    
    private $singleton_instances = [];
    
    public function setSingletons($array)
    {
        if(is_array($array)) {
            foreach($array as $key => $value) {
                if(is_numeric($key)) {
                    $this->singletons[] = $value;
                    $this->singleton_params[$value] = NULL;
                } else {
                    $this->singletons[] = $key;
                    $this->singleton_params[$key] = $value;
                }
            }
        }
        
    }
    
    public function getSingleton($full_class_name)
    {
        if(in_array($full_class_name, $this->singletons)) {
            if(empty($this->singleton_instances[$full_class_name])) {
                $this->singleton_instances[$full_class_name] = new $full_class_name($this->singleton_params[$full_class_name]);
                return $this->singleton_instances[$full_class_name];
            } else {
                return $this->singleton_instances[$full_class_name];
            }
        }
    }
}