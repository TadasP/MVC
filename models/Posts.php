<?php

include_once url.'libs/Database.php';

class Posts
{
    public function getAllPosts()
    {
        $db = new Database();
        $db->select()->from('posts');
        return $db->get();
    }

    public function getPostById($id)
    {
        $db = new Database();
        $db->select()->from('posts')->where('id',$id);
        return $db->get();
    }

    public function getPostBySlug($slug)
    {
        $db = new Database();
        $db->select()->from('posts')->where('slug',$slug);
        return $db->get();
    }

    public function insertPost()
    {
        $db = new Database();
    }

    public function deletePost()
    {

    }
}