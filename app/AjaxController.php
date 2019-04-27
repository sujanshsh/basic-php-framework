<?php

namespace app;

use Library\JsonResponse;
use Library\MySQLDatabase;
use app\Repositories\ExampleRepository;

class AjaxController extends MainController
{

    private $jr;
    
    private $db;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->jr = new JsonResponse();
        
        $this->db = app()->getSingleton(MySQLDatabase::class);
    }
    
    public function example($name = '')
    {
        $er = new ExampleRepository($this->db);
        
        $data = $ccr->example($name);
        
        return $this->jr->response($data);
    }

}
