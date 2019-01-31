<?php

namespace App\Controllers;

use App\Libs\Controller;
use App\Models\Comments;
use App\Helpers\FormHelper;
use App\Helpers\Helper;

class CommentsController extends Controller
{
    public function storeComment($postId)
    {   
        $comments = new Comments();

        if(isset($_POST['submit'])){
            $author_id = $_SESSION['loggedIn'];
            $content = !empty($_POST['comment']) ? $_POST['comment'] : NULL;
            if(isset($content)){
                $comments->addComment($author_id, $postId, $content);
            }
        }

        header("Location: http://localhost:8081/2lvl/Tadas/MVC/index.php/posts/show/".$postId);
    }

    public function editComment($commentId)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/MVC/index.php/comments/updateComment/'.$commentId);
        $comments = new Comments();
        $comment = $comments->getCommentById($commentId);
        $info = $comment->fetch_assoc();

        $form->textarea([
            'class' => 'form-control col-md-6',
            'name' => 'comment',
            'rows' => 8,
            'placeholder' => 'Comment',
        ],'',$info['content']);

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Edit'
        ]);

        $this->view->title = 'Edit Comment';
        $this->view->editForm = $form->get();
        $this->view->render('comments');
    }

    public function updateComment($id)
    {
        $comments = new Comments();
        $comment = $comments->getCommentById($id);
        $info = $comment->fetch_assoc();
        
        if(isset($_POST['submit'])){
            $content = $_POST['comment'];
            $comments->updateComment($id, $content);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/MVC/index.php/posts/show/".$info['post_id']);
    }

    public function deleteComment($id)
    {
        $comments = new Comments();
        $comment = $comments->getCommentById($id);
        $info = $comment->fetch_assoc();

        $comments->deleteComment($id);

        header("Location: http://localhost:8081/2lvl/Tadas/MVC/index.php/posts/show/".$info['post_id']);
    }
}