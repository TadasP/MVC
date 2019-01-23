<?php

include_once url.'libs/Database.php';

class Posts
{
    public function getAllPosts()
    {
        $db = new Database();
        $db->select()->from('posts')->where('active', 1);
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

    public function updatePost($id, $slug, $title, $content, $photo, $time)
    {
        $db = new Database();
        $db->update('posts')
            ->set([
            '`slug`' => $slug,
            '`title`' => $title,
            '`content`' => $content,
            '`photo`' => $photo,
            '`createtime`' => $time
            ])  
            ->where('id',$id);
        return $db->get();
    }
    public function deletePost($id)
    {
        $db = new Database();
        $db->update('posts')
            ->set([
            '`active`' => 0,
            ])
            ->where('id',$id);
        return $db->get();
    }

}