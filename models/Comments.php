<?php

include_once url.'libs/Database.php';

class Comments
{
    public function addComment($author_id, $post_id, $content)
    {
        $db = new Database();
        $db->insert()
            ->into('comments')
            ->row(['`author_id`','`post_id`','`content`'])
            ->value([$author_id, $post_id, $content]);
        return $db->get();    
    }
}
