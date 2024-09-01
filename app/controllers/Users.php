<?php

class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index() {}

    public function register($data = [])
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_error' => '',
            'email_error' => '',
            'password_error' => '',
            'confirm_password_error' => '',
            'url' => 'register'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form;
            $data['email'] = trim($_POST['email']);
            $data['name'] = trim($_POST['name']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);


            //Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter an email.';
            } else {
                $emailAlreadyExists = $this->userModel->findUserByEmail($data['email']);

                if ($emailAlreadyExists) {
                    $data['email_error'] = 'This email is already being used.';
                }
            }

            //Validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter your name.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter an password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Your password has to be at least 6 characterts.';
            }

            //Validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm your password.';
            } elseif ($data['confirm_password'] !== $data['password']) {
                $data['confirm_password_error'] = 'The passwords do not match.';
            }

            //Make sure errors are empty

            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // die('success');
                // At this point everything is validated

                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User


                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    echo 'It was not possible to register the user !';
                }
            }
        }




        $this->view('users/register', $data);
    }

    public function login($data = [])
    {

        $data = [
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => '',
            'url' => 'login'
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form;
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);


            //Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter an email.';
            }


            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter an password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Your password has to be at least 6 characterts.';
            }

            //Check for user/email
            if (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'No user found, please check the email you entered.';
            }

            //Make sure errors are empty

            if (empty($data['email_error']) && empty($data['password_error'])) {

                // die('success');
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //Create Session 
                    $this->createUserSession($loggedInUser);
                    die('success');
                } else {
                    $data['password_error'] = 'Incorrect password';
                }
            }
        }
        $this->view('users/login', $data);
    }

    public function logout()
    {

        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();

        redirect('users/login');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('posts/index');
    }
}
