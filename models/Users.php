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

    public function getUserByPassword($password)
    {
        $db = new Database();
        $db->select()->from('users')->where('password',$password);
        return $db->get();
    }

    public function getUserIdByEmail($email)
    {
        $db = new Database();
        $db->select('id')->from('users')->where('email',$email);
        return $db->get();
    }

    public function getUserInfoByEmail($email, $password)
    {
        $db = new Database();
        $db->select()->from('users')->where('email',$email)->whereAnd('password',$password)->whereAnd('active',1);
        return $db->get();    
    }

    public function getAllPostsByUserId($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('author_id',$id)->whereAnd('active',1);
        return $db->get();
    }

    public function getAllPostsByUserName($name)
    {
        $db = new Database();
        $db->select()->from('posts')->where('name',$name)->whereAnd('active',1);
        return $db->get();
    }

    public function checkIfUserActiveByEmail($email)
    {
        $db = new Database();
        $db->select('active')->from('posts')->where('email',$email);
        return $db->get();
    }

    public function registrate($name, $email, $password)
    {
        $db = new Database();
        $db->insert()
            ->into('users')
            ->row(['`name`','`email`','`password`'])
            ->value([$name, $email, $password]);
        return $db->get();    
    }

    public function delete($id)
    {
        $db = new Database();
        $db->update('users')
            ->set([
            '`active`' => 0,
            ])
            ->where('id',$id);
        return $db->get();
    }

    public function updateName($name, $id)
    {
        $db = new Database();
        $db->update('users')
            ->set([
            '`name`' => $name
            ])  
            ->where('id',$id);
        return $db->get();
    }

    public function updateEmail($email, $id)
    {
        $db = new Database();
        $db->update('users')
            ->set([
            '`email`' => $email
            ])  
            ->where('id',$id);
        return $db->get();
    }
    
    public function updatePassword($password, $id)
    {
        $db = new Database();
        $db->update('users')
            ->set([
            '`password`' => $password
            ])  
            ->where('id',$id);
        return $db->get();
    }
    
}
