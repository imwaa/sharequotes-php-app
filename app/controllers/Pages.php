<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            'title' => 'Share Quotes',
        ];

        $this->view('users/login', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About us'
        ];
        $this->view('pages/about', $data);
    }
}
