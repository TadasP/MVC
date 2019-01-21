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

    public function insertPost($slug, $title, $content, $author, $time)
    {
        $db = new Database();
        $db->insert()
        ->into('posts')
        ->row(['`slug`','`title`','`content`','`author_id`','`createtime`'])
        ->value([$slug, $title, $content, $author, $time]);
        return $db->get();
    }

    public function addPost($slug, $title, $content, $photo, $time)
    {
        $db = new Database();
        $db->insert()
        ->into('posts')
        ->row(['`slug`','`title`','`content`','`photo`','`createtime`'])
        ->value([$slug, $title, $content, $photo, $time]);
        return $db->get();    
    }

    public function deletePost()
    {

    }
}