<?php

class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        //GET POSTS
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }


    public function add()
    {
        $data = [
            'body' => '',
            'author' => '',

        ];

        $this->view('posts/add');
    }
}
