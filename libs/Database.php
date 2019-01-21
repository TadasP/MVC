<?php

class Database
{
    private $conn;
    private $query = '';

    public function connect()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'mvc_php');

        if(!$this->conn){
            echo "Error: Unable to connect to MySQL.".PHP_EOl;
            echo "Debugging error" .mysqli_connect_errno().PHP_EOl;
            exit; 
        }
    }

    public function select($target = '*')
    {
        $this->query = 'SELECT '.$target.' ';
        return $this;
    }

    public function update($tableName)
    {
        $this->query = 'UPDATE '.$tableName.' ';
        return $this;
    }

    public function insert()
    {
        $this->query = 'INSERT ';
        return $this;
    }

    public function delete()
    {
        $this->query = 'DELETE ';
        return $this;
    }

    public function into($tableName)
    {
        $this->query .='INTO '.$tableName.' ';
        return $this;
    }

    public function row($rows)
    {
        $this->query .='(';
        foreach ($rows as $row){
            $this->query .= $row.',';
        }
        $query = $this->query;
        $this->query = substr($query, 0, -1);
        $this->query .= ') ';
        return $this;
    }

    public function value($values)
    {
        $this->query .='VALUES (';
        foreach ($values as $value){
            $this->query .= "'".$value."',";
        }
        $query = $this->query;
        $this->query = substr($query, 0, -1);
        $this->query .=')';
        return $this;
    }

    public function from($tableName)
    {
        $this->query .='FROM '.$tableName.' ';
        return $this;
    }

    public function where($field, $value, $operator = '=')
    {
        $this->query .='WHERE '.$field.' '.$operator.' '.$value.' ';
        return $this;
    }

    public function whereAnd($field, $value, $operator = '=')
    {
        $this->query .='AND '.$field.' '.$operator.' '.$value.' ';
        return $this;
    }

    public function whereOr($field, $value, $operator = '=')
    {
        $this->query .='OR '.$field.' '.$operator.' '.$value.' ';
        return $this;
    }
    
    public function get(){
        $conn = $this->connect();
        $result = mysqli_query($this->conn, $this->query);
        return $result;
    }
}