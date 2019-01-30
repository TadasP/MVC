<?php

namespace App\Models;

use App\Libs\Database;

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
        $db->select('posts.id, posts.title, posts.content, posts.photo, posts.createtime, posts.author_id, users.name')
            ->from('posts')
            ->joinOn('users','posts.author_id','users.id')
            ->where('posts.id',$id)
            ->whereAnd('posts.active', 1);
        return $db->get();
    }

    public function getPostBySlug($slug)
    {
        $db = new Database();
        $db->select()->from('posts')->where('slug',$slug);
        return $db->get();
    }

    public function addPost($slug, $title, $content, $photo, $time, $author_id)
    {
        $db = new Database();
        $db->insert()
            ->into('posts')
            ->row(['`slug`','`title`','`content`','`photo`','`createtime`','`author_id`'])
            ->value([$slug, $title, $content, $photo, $time, $author_id]);
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

    public function getAllCommentsByPostId($id)
    {
        $db = new Database();
        $db->select('comments.id, comments.content, users.name, users.email')
            ->from('comments')
            ->joinOn('users','comments.author_id','users.id')
            ->where('post_id',$id)
            ->whereAnd('comments.active', 1);
        return $db->get();
    }

    public function getPostIdBySlug($slug)
    {
        $db = new Database();
        $db->select('id')->from('posts')->where('slug', $slug);
        return $db->get();
    }

    public function getUserNameByUserId($id)
    {
        $db = new Database();
        $db->select('name')->from('users')->where('id', $id);
        return $db->get();
    }

    public function getAllPostsBySearchNeedle($searchInput)
    {
        $db = new Database();
        $db->select()
            ->from('posts')
            ->like('title',$searchInput, '%', '%')
            ->likeOr('content',$searchInput, '%', '%');
        return $db->get();
    }
}