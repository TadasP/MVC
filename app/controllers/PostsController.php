<?php

namespace App\Controllers;

use App\Libs\Controller;
use App\Models\Posts;
use App\Helpers\FormHelper;
use App\Helpers\Helper;

class PostsController extends Controller
{
    public function index()
    {
        $posts = new Posts();
        $this->view->title = 'Posts';
        $posts = $posts->getAllPosts();
        $postsView = [];
        while($post = $posts->fetch_assoc()){
            $postsView[] =  $post;
        }
        $this->view->posts = $postsView;
        $this->view->headline = 'Posts';
        $this->view->render('posts');
    }

    public function show($var)
    {
        $posts = new Posts();
        $this->view->title = 'Post';
        if(is_numeric($var)){
            $post = $posts->getPostById($var);
        }else{
            $post = $posts->getPostBySlug($var);
        }

        $postView = $post->fetch_assoc();
        $this->view->post = $postView;

        
        if(is_numeric($var)){
            $comments = $posts->getAllCommentsByPostId($var);
        }else{
            $id = getPostIdBySlug($var);
            $id = $id->fetch_assoc();
            $comments = $posts->getAllCommentsByPostId($id['id']);
        }

        $commentsView = [];
        
        while($comment = $comments->fetch_assoc()){
            $commentsView[] =  $comment;
        }

        $this->view->comments = $commentsView;

        if(isset($_SESSION['loggedIn'])){
            $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/comments/storeComment/'.$var);

            $form->textarea([
                'class' => 'form-control col-md-6',
                'name' => 'comment',
                'rows' => 8,
                'placeholder' => 'New comment'
            ]);

            $form->input([
                'class' => 'btn btn-success btn-send',
                'name' => 'submit',
                'type' => 'submit',
                'value' => 'Add'
            ]);

        $this->view->commentForm = $form->get();
        }
        
        $this->view->render('posts');
    }

    public function add()
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/posts/storePost');
       
        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title'
        ],'Title');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Image URL'
        ],'Image');

        $form->input([
            'class' => 'form-check',
            'name' => 'public',
            'type' => 'checkbox',
            'value' => 1
        ],'Public');

        $form->select([
            'class' => 'form-control col-md-6',
        ],['maxima','iki','rimi'],'Workplace');

        $form->textarea([
            'class' => 'form-control col-md-6',
            'name' => 'content',
            'rows' => 4,
            'placeholder' => 'Content'
        ], 'Content');

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Add'
        ]);

        $this->view->title = 'Add';
        $this->view->form = $form->get();
        $this->view->render('posts');
    }

    public function storePost()
    {
        $posts = new Posts();

        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $slug = Helper::getSlug($_POST['title']);
            $content = $_POST['content'];
            $photo = $_POST['image'];
            $time = date("Y-m-d H:i:s");
            $author_id = $_SESSION['loggedIn'];
            $posts->addPost($slug, $title, $content, $photo, $time, $author_id);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }

    public function edit($id)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/posts/updatePost/'.$id);
        $posts = new Posts();
        $post = $posts->getPostById($id);
        $info = $post->fetch_assoc();

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title',
            'value' => $info['title']
        ],'Title*');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Image URL',
            'value' => $info['photo']
        ],'Image*');

        $form->input([
            'class' => 'form-check',
            'name' => 'public',
            'type' => 'checkbox',
            'value' => 1
        ],'Public');

        $form->select([
            'class' => 'form-control col-md-6',
        ],['maxima','iki','rimi'],'Workplace');

        $form->textarea([
            'class' => 'form-control col-md-6',
            'name' => 'content',
            'rows' => 4,
            'placeholder' => 'Content',
        ], 'Content*', $info['content']);

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'update',
            'type' => 'submit',
            'value' => 'Update'
        ]);

        $this->view->title = 'Edit';
        $this->view->form = $form->get();
        $this->view->render('posts');

    }

    public function updatePost($id)
    {
        $posts = new Posts();

        if(isset($_POST['update'])){
            $title = $_POST['title'];
            $slug = Helper::getSlug($_POST['title']);
            $content = $_POST['content'];
            $photo = $_POST['image'];
            $time = date("Y-m-d H:i:s");
            $posts->updatePost($id, $slug, $title, $content, $photo, $time);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }

    public function deletePost($id)
    {
        $posts = new Posts();

        if(isset($_POST['delete-post'])){
            $posts->deletePost($id);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }

    public function searchPost()
    {
        $posts = new Posts();
        $resultsView = [];

        if(isset($_POST['search_posts'])){
            $searchNeedle = !empty($_POST['search_needle']) ? $_POST['search_needle'] : NULL;
            if(!empty($_POST['search_needle'])){
                $searchNeedle = strtolower($searchNeedle);
                $SearchResults = $posts->getAllPostsBySearchNeedle($searchNeedle);
                if(mysqli_num_rows($SearchResults) > 0){
                    while($post = $SearchResults->fetch_assoc()){
                        $resultsView[] = $post;
                    }
                    $this->view->positiveSearchResults = $resultsView;
                }else{
                    $this->view->negativeSearchResults = '0 results';
                }
           }else{
                $this->view->negativeSearchResults = '0 results';    
           }         
        } 

        $this->view->needle = $searchNeedle;
        $this->view->title = 'Search Results';
        $this->view->render('posts');  
    }
}