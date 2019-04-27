<?php
namespace Library;

use Exceptions\SqlParseErrorException;
use Exceptions\SqlExecutionErrorException;

/**
 * *
 *
 * @author Sujan Shakya
 *        
 *         Class for Database Connection to MySQL Database
 *        
 */
class MySQLDatabase
{

    /**
     * mysqli_connect link resource
     *
     * @var resource
     */
    protected $link;

    /**
     * true for connected, false for not-connected
     *
     * @var bolean
     */
    protected $connected = false;

    
    public function __construct()
    {
        $this->connect(Config::get('MySQLDatabase'));
    }

    /**
     * Destructor
     * close database connection if connected
     */
    public function __destruct()
    {
        if ($this->link) {
            mysqli_close($this->link);
        }
    }

    /**
     * *
     *
     *
     * @param array $params            
     * @return boolean true if connected, false if not connected
     */
    public function connect($params)
    {
        $username = $this->safeRead($params, 'username');
        $password = $this->safeRead($params, 'password');
        $host = $this->safeRead($params, 'host');
        $database = $this->safeRead($params, 'database');
        $port_number = $this->safeRead($params, 'port', '1521');
        
        $this->link = mysqli_connect($host,$username,$password,$database);
		if (! $this->link) {
            $this->connected = false;
			throw new \DatabaseConnectionErrorException([
                'error_no' => mysqli_connect_errno(),
                'error_message' => mysqli_connect_error()
            ]);
        } else {
            $this->connected = true;
        }
        
        return $this->connected;
    }


    /**
     * Execute query and return MySQLDatabaseResult object
     *
     * @param string $sql            
     * @return boolean|MySQLDatabaseResult false if error, resouce if success
     *        
     * @throws SqlParseErrorException, SqlExecutionErrorException
     *
     *
     */
    public function query($sql)
    {
        if ($this->connected) {
            
            $result = mysqli_query($this->link, $sql);
            if ($result === false) {
                throw new SqlExecutionErrorException([
                    'error_no' => mysqli_errno($this->link),
                    'error_message' => mysqli_error($this->link)
                ]);
            }
            return new MySQLDatabaseResult($result);
        }
        
        return NULL;
    }

    /**
     * utility function, checks if isset(), if not then returns default value
     *
     * @param mixed $array            
     * @param mixed $key            
     * @param mixed $default            
     */
    private function safeRead(&$array, $key, $default = '')
    {
        if (isset($array[$key]))
            return $array[$key];
        else
            return $default;
    }
}