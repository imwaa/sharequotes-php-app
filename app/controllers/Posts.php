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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sainitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'body' => trim($_POST['body']),
                'author' => trim($_POST['author']),
                'user_id' => $_SESSION['user_id'],
                'author_err' => '',
                'body_err' => '',
            ];

            // VALIDATE AUTHOR
            if (empty($data['author'])) {
                $data['author_err'] = 'Please enter an Author';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a Quote';
            }

            //MAKING SURE THERE ARE NO ERRORS
            if (empty($data['author_err']) && empty($data['body_err'])) {
                // VALIDATED
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Quote added successfully');
                    redirect('posts');
                } else {
                    die('something went wrong with the post');
                }
            } else {
                // LOAD THE VIEW WITH ERRORS
                $this->view('posts/add', $data);
            }
        } else {

            $data = [
                'body' => '',
                'author' => '',

            ];

            $this->view('posts/add');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sainitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'body' => trim($_POST['body']),
                'author' => trim($_POST['author']),
                'user_id' => $_SESSION['user_id'],
                'author_err' => '',
                'body_err' => '',
            ];

            // VALIDATE AUTHOR
            if (empty($data['author'])) {
                $data['author_err'] = 'Please enter an Author';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a Quote';
            }

            //MAKING SURE THERE ARE NO ERRORS
            if (empty($data['author_err']) && empty($data['body_err'])) {
                // VALIDATED
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Quote updated successfully');
                    redirect('posts/myposts');
                } else {
                    die('something went wrong with the post');
                }
            } else {
                // LOAD THE VIEW WITH ERRORS
                $this->view('posts/edit', $data);
            }
        } else {

            //GET EXISTING POST MODEL
            $post = $this->postModel->getPostById($id);
            //CHECK FOR OWNER
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'body' => $post->body,
                'author' => $post->author,

            ];

            $this->view('posts/edit', $data);
        }
    }

    public function myPosts()
    {
        $posts = $this->postModel->getMyPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/myposts', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $post = $this->postModel->getPostById($id);
            //CHECK FOR OWNER
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Quote delete successfully');
                redirect('posts/myposts');
            } else {
                die('something went wrong');
            }
        } else {
            redirect('posts/myposts');
        }
    }
}
