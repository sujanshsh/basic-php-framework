<?php

namespace app\Repositories;

use Library\MySQLDatabase;

class ExampleRepository
{
    
    private $db;

    
    public function __construct(MySQLDatabase $db)
    {
        $this->db = $db;
    }
    
    public function example($name)
    {
        
        $sql = "
            SELECT
                name,
                dob,
                address,
                email,
                mobile_number
            FROM
                users
            WHERE name = '$name'
        ";
        
        return $this->db->query($sql)->fetchAllRows();
    }

}