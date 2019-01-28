<?php

include_once url.'libs/Controller.php';
include_once url.'models/Comments.php';
include_once url.'helpers/FormHelper.php';
include_once url.'helpers/Helper.php';

class CommentsController extends Controller
{
    public function addComment($postId)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/comments/storeComment/'.$postId);

        $form->textarea([
            'class' => 'form-control col-md-6',
            'name' => 'comment',
            'rows' => 8,
            'placeholder' => 'Comment'
        ]);

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Add'
        ]);

        $this->view->title = 'Add Comment';
        $this->view->form = $form->get();
        $this->view->render('comments');
    }

    public function storeComment($postId)
    {   
        $comments = new Comments();

        if(isset($_POST['submit'])){
            $author_id = $_SESSION['loggedIn'];
            $content = $_POST['comment'];
            $comments->addComment($author_id, $postId, $content);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/show/".$postId);
    }

    public function editComment($commentId)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/comments/updateComment/'.$commentId);
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

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/show/".$info['post_id']);
    }
}