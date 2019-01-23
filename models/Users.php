<?php

include_once url.'libs/Database.php';

class Users
{
    public function getAllUsers()
    {
        $db = new Database();
        $db->select()->from('users')->where('active', 1);
        return $db->get();
    }

    public function getUserById($id)
    {
        $db = new Database();
        $db->select()->from('users')->where('id',$id);
        return $db->get();
    }

    public function getUserByName($name)
    {
        $db = new Database();
        $db->select()->from('users')->where('name',$name);
        return $db->get();
    }

    public function getUserByEmail($email)
    {
        $db = new Database();
        $db->select()->from('users')->where('email',$email);
        return $db->get();
    }

    public function registrate($email, $name, $password)
    {
        $db = new Database();
        $db->insert()
        ->into('users')
        ->row(['`email`','`name`','`password`'])
        ->value([$email, $name, $password]);
        return $db->get();    
    }

    public function login($email, $password)
    {

    }
}

// coments-table (id, content, author_id, post_id