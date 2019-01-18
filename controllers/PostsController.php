<?php

include_once url.'libs/Controller.php';
include_once url.'models/Posts.php';

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

    public function insert()
    {
        $posts = new Posts();
        $this->view->title = 'Insert post';
        $this->view->render('insertPost');
    }
}