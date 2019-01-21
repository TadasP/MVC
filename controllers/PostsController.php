<?php

include_once url.'libs/Controller.php';
include_once url.'models/Posts.php';
include_once url.'helpers/FormHelper.php';

class PostsController extends Controller
{
    public function index()
    {
        $posts = new Posts();
        $this->view->title = 'Posts';
        $this->view->posts = $posts->getAllPosts();
        $this->view->headline = 'Posts';
        $this->view->render('posts');
    }

    public function show($id)
    {
        $posts = new Posts();
        $this->view->title = 'Post';
        $this->view->post = $posts->getPostById($id);
        $this->view->render('posts');
    }

    public function add()
    {
        $form = new FormHelper('POST','');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title'
        ])->input([
            'class' => 'form-control col-md-6',
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Image URL'
        ])->input([
            'class' => 'form-check',
            'name' => 'public',
            'type' => 'checkbox',
            'value' => 1
        ])->select([
            'class' => 'form-control col-md-6',
            'name' => 'workplace'
        ],['maxima','iki','rimi'])->textarea([
            'class' => 'form-control col-md-6',
            'name' => 'content',
            'rows' => 4,
            'placeholder' => 'Content'
        ])->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Add'
        ]);

        $this->view->title = 'Add';
        $this->view->form = $form->get();
        $this->view->render('posts');
    }


    public function insert()
    {
        $posts = new Posts();
        $this->view->title = 'Insert post';
        $this->view->render('insertPost');
        if(isset($_POST['insert-post'])){
            $title = $_POST['title'];
            $slug = strtolower(strtr($_POST['title'], [' ' => '-']));
            $content = $_POST['content'];
            $author = $_POST['author'];
            $time = date("Y-m-d H:i:s");
            $posts->insertPost($slug, $title, $content, $author, $time);
        }
    }
}