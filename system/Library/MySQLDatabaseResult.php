<?php
namespace Library;

/**
 * *
 *
 * @author Sujan Shakya
 *        
 *         Class for Fetching Rows from Database Connection to MySQL Database
 *        
 */
class MySQLDatabaseResult
{

    /**
     * mysqli result resource
     *
     * @var resource
     */
    protected $result;

    /**
     * type to use to store row in array
     *
     * @var string
     */
    protected $result_row_type = 'object';
    
    /**
     * array to store fetched rows
     *
     * @var array
     */
    protected $result_rows_array = [];
    
    /**
     * internal row pointer
     *
     * @var int
     */
    protected $current_result_row = 0;
    
    
    public function __construct($result)
    {
        $this->result = $result;
    }
    
    public function setResultRowType($type = 'object')
    {
        $this->result_row_type = $type;
    }

    public function fetchAllRows()
    {
        $this->_fetchAllRows();
        
        return $this->result_rows_array;
    }

    public function fetchRow()
    {
        if(count($this->result_rows_array) > 0) { // if already rows fetched and cached
            if($this->current_result_row == count($this->result_rows_array))
                $row = NULL;
            else
                $row = $this->result_rows_array[$this->current_result_row++];
        } else {
            $row = $this->_fetch_array();
        }
        
        return $row;
    }

    public function countRows()
    {
        $this->_fetchAllRows();
        
        return count($this->result_rows_array);
    }

    private function _fetchAllRows()
    {
        if (count($this->result_rows_array) > 0)
            return;
        
        while ($row = $this->_fetch_array()) {
            $this->result_rows_array[] = $row;
        }
    }
    
    private function _fetch_array()
    {
        if ($this->result_row_type === 'object') {
            return mysqli_fetch_object($this->result);
        } else {
            return mysqli_fetch_assoc($this->result);
        }
    }
}