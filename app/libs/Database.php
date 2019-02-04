<?php

namespace App\Libs;

class Database
{
    private $conn;
    private $query = '';

    public function connect()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'mvc_php');
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

    public function set($values)
    {
        $this->query .='SET ';
        foreach ($values as $key => $value){
            $this->query .= $key."="." '".$value."',";
        }
        $query = $this->query;
        $this->query = substr($query, 0, -1);
        $this->query .= ' ';
        return $this;
    }

    public function from($tableName)
    {
        $this->query .='FROM '.$tableName.' ';
        return $this;
    }

    public function where($field, $value, $operator = '=')
    {
        $this->query .='WHERE '.$field.' '.$operator.' "'.$value.'" ';
        return $this;
    }

    public function whereAnd($field, $value, $operator = '=')
    {
        $this->query .='AND '.$field.' '.$operator.' "'.$value.'" ';
        return $this;
    }

    public function whereOr($field, $value, $operator = '=')
    {
        $this->query .='OR '.$field.' '.$operator.' '.$value.' ';
        return $this;
    }

    public function joinOn($table, $row1, $row2)
    {
        $this->query .='INNER JOIN '.$table.' ON '.$row1.'='.$row2.' ';
        return $this;
    }

    public function like($haystack, $needle, $operator1='%', $operator2='%')
    {
        $this->query .='WHERE lower('.$haystack.') LIKE '.'"'.$operator1.$needle.$operator2.'"';
        return $this;
    }

    public function likeOr($haystack, $needle, $operator1='%', $operator2='%')
    {
        $this->query .='OR lower('.$haystack.') LIKE '.'"'.$operator1.$needle.$operator2.'"';
        return $this;
    }

    public function prepareAndBind($operators, $values)
    {
        $conn = mysqli_connect('localhost', 'root', '', 'mvc_php');
        $statement = $conn->prepare($this->query);
        if(count($values) == 6){
            $statement->bind_param($operators, $values[0], $values[1], $values[2], $values[3], $values[4], $values[5]);    
        }elseif(count($values) == 5){
            $statement->bind_param($operators, $values[0], $values[1], $values[2], $values[3], $values[4]);
        }elseif(count($values) == 4){
            $statement->bind_param($operators, $values[0], $values[1], $values[2], $values[3]);
        }elseif(count($values) == 3){
            $statement->bind_param($operators, $values[0], $values[1], $values[2]);
        }elseif(count($values) == 2){
            $statement->bind_param($operators, $values[0], $values[1]);
        }else{
            $statement->bind_param($operators, $values[0]);   
        }
        $statement->execute();
    }

    public function getQuery()
    {
        return $this->query;
    }
    
    public function get()
    {
        $conn = $this->connect();
        $result = mysqli_query($this->conn, $this->query);
        return $result;
    }
}