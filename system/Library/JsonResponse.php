<?php

namespace Library;

/**
 * *
 *
 * @author shakya.sujan
 */

class JsonResponse
{

    private $config = [];
    
    public function __construct()
    {
        $this->config = Config::get('JsonResponse');
    }
    
    public function response($content, $code = NULL)
    {
        if (empty($content) && $code === NULL) $code = 404;
        elseif (! empty($content) && $code === NULL) $code = 200;
        elseif (! is_numeric($code)) return;

        $text = $this->config['status_code_mapping'][(int)$code];       
            
        if(empty($text))
            return;
        
		header($_SERVER['SERVER_PROTOCOL'].' '.$code.' '.$text, TRUE, $code);
        header("Content-Type: application/json");

        if (is_array($content) || get_class($content) == 'stdClass') {
            echo json_encode($content);
        } else {
            echo $content;
        }
    }
}