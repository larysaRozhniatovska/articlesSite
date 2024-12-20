<?php

namespace app\lib;

use Couchbase\QueryErrorException;
use http\Exception\BadQueryStringException;
use MongoDB\Driver\Exception\ConnectionException;

class AbstractDB
{
    protected \mysqli $db;
    protected string $table;

    /**
     * database query  fetch_all
     * @param string $query
     * @return bool|array
     * @throws QueryErrorException
     */
    public function queryAll(string $query) : bool | array
    {
        $result = $this->db->query($query);
        if(!$result){
            throw new QueryErrorException();
        }
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return true;
    }

    /**
     * request completed or not completed
     * @param string $query
     * @return bool
     * @throws QueryErrorException
     */
    public function queryBool(string $query) : bool
    {
        $result = $this->db->query($query);
        if(!$result){
            throw new QueryErrorException();
        }
        return $result;
    }
    /**
     * database query  fetch_assoc
     * @param string $query
     * @return bool|array
     * @throws QueryErrorException
     */
    public function queryRow(string $query) : bool | array
    {
        $result = $this->db->query($query);

        if(!$result){
            throw new QueryErrorException();
        }
        return $result->fetch_assoc();
    }
    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);
        if($this->db->connect_errno != 0){
             throw new ConnectionException();
        }
    }

    /**
     * all entries in $this->table
     * @return bool|array
     * @throws QueryErrorException
     */
    public function getAll() : bool | array
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->queryAll($query);
    }

    /**
     * all records with id &  $field in $this->table
     * @param string $field
     * @return array
     * @throws QueryErrorException
     */
    public function getAllIdAndField(string $field) : array
    {
        $query = "SELECT id,{$field} FROM {$this->table}";
        return $this->queryAll($query);
    }

    /**
     * return all fields by id
     * @param int $id
     * @return array
     * @throws QueryErrorException
     */
    public function getAllbyId(int $id) : array
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->queryRow($query);
    }

    /**
     * delete record
     * @param int $id
     * @return bool
     * @throws QueryErrorException
     */
    public function delRow(int $id) : bool
    {
        $query = "DELETE FROM {$this->table} WHERE id= {$id}";
        return $this->queryBool($query);
    }

}