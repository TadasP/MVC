<?php

include_once url.'libs/Database.php';

class Comments
{
    public function getCommentById($commentId)
    {
        $db = new Database();
        $db->select()->from('comments')->where('id',$commentId);
        return $db->get();  
    }

    public function addComment($author_id, $post_id, $content)
    {
        $db = new Database();
        $db->insert()
            ->into('comments')
            ->row(['`author_id`','`post_id`','`content`'])
            ->value([$author_id, $post_id, $content]);
        return $db->get();    
    }

    public function updateComment($id, $content)
    {
        $db = new Database();
        $db->update('comments')
            ->set([
            '`content`' => $content
            ])  
            ->where('id',$id);
        return $db->get();
    }
}
