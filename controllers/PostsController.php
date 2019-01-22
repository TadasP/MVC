<?php

include_once url.'libs/Controller.php';
include_once url.'models/Posts.php';
include_once url.'helpers/FormHelper.php';
include_once url.'helpers/Helper.php';

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

    public function show($var)
    {
        $posts = new Posts();
        $this->view->title = 'Post';
        if(is_numeric($var)){
            $this->view->post = $posts->getPostById($var);
        }else{
            $this->view->post = $posts->getPostBySlug($var);
        }
        $this->view->render('posts');
    }

    public function add()
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/posts/store');
       
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

    public function insert()
    {
        $this->view->title = 'Insert post';
        $this->view->render('insertPost');
    }

    public function store()
    {
        $posts = new Posts();

        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $slug = Helper::getSlug($_POST['title']);
            $content = $_POST['content'];
            $photo = $_POST['image'];
            $time = date("Y-m-d H:i:s");
            $posts->addPost($slug, $title, $content, $photo, $time);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }

    public function edit($id)
    {
        $form = new FormHelper('POST','/2lvl/Tadas/Model-view-controler/index.php/posts/update/'.$id);
        $posts = new Posts();
        $post = $posts->getPostById($id);
        $info = $post->fetch_assoc();

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title',
            'value' => $info['title']
        ],'Title');

        $form->input([
            'class' => 'form-control col-md-6',
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Image URL',
            'value' => $info['photo']
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
            'placeholder' => 'Content',
        ], 'Content', $info['content']);

        $form->input([
            'class' => 'btn btn-success btn-send',
            'name' => 'update',
            'type' => 'submit',
            'value' => 'Update'
        ]);

        $this->view->title = 'Add';
        $this->view->form = $form->get();
        $this->view->render('posts');

    }

    public function update($id)
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

    public function delete()
    {
        if(isset($_POST['delete'])){
            $posts->updatePost($id, $slug, $title, $content, $photo, $time);
        }
        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }

    public function oldStore()
    {
        $posts = new Posts();

        if(isset($_POST['insert-post'])){
            $title = $_POST['title'];
            $slug = Helper::getSlug($_POST['title']);
            $content = $_POST['content'];
            $author = $_POST['author'];
            $time = date("Y-m-d H:i:s");
            $posts->insertPost($slug, $title, $content, $author, $time);
        }

        header("Location: http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/posts/index");
    }
}