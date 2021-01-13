<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // CHECK FOR POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                //CHECK EMAIL
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Êmail alredy taken';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated


                // HASH THE PASSWORD
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);


                // REGISTER USER
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are now registered! You can Log in');
                    redirect('users/login');
                } else {
                    die('error to register');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // INIT data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];


            // LOAD VIEW
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // CHECK FOR POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Pleae enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // CHECK FOR USER/EMAIL
            if ($this->userModel->findUserByEmail($data['email'])) {
                //user found
            } else {
                //user not found
                $data['email_err'] = 'No user found';
            }

            // MAKE SURE THERE ARE NO ERRORS
            if (empty($data['email_err']) && empty($data['password_err'])) {
                //CHECK AND SET LOGGED IN USER

                // loggedInUser WILL CONTAINER EITHER THE INFO OF THE USER OR WILL CONTAIN FALSE
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    die('SUCCESS');
                } else {
                    $data['password_err'] = 'Password incorrect !';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // INIT data
            $data = [

                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];


            // LOAD VIEW
            $this->view('users/login', $data);
        }
    }
}
