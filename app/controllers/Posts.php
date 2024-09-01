<?php

class Posts extends Controller
{
    private $postsModel;
    private $usersModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('pages/login');
        }

        $this->postsModel = $this->model('post');
        $this->usersModel = $this->model('user');
    }

    public function index()
    {
        $posts = $this->postsModel->getPosts();
        $posts_count = count($posts);
        //print_r($posts);
        $data = ['posts' => $posts, 'url' => 'posts', 'posts_count' => $posts_count];

        $this->view('posts/index', $data);
    }

    public function add()
    {

        $data = ['body_error' => '', 'title_error' => '', 'url' => 'add'];

        $formSubmitted = $_SERVER['REQUEST_METHOD'] == 'POST';

        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if ($formSubmitted) {
            $body = trim($_POST['body']);
            $title = trim($_POST['title']);

            if (empty($title)) {
                $data['title_error'] = 'Plase, inform the post title.';
            }

            if (empty($body)) {
                $data['body_error'] = 'Plase, share your thoughts with us.';
            }

            if (empty($data['body_error']) && empty($data['title_error'])) {

                $row = $this->postsModel->addPost($title, $body);

                if ($row) {
                    flash('post_message', 'Post Added!');
                    redirect('posts/index');
                } else {
                    die('Something went wrong.');
                }

                //add post to the database
            }
        }


        $this->view('posts/add', $data);
    }


    public function edit($post_id)
    {

        $data = ['body_error' => '', 'title_error' => '', 'url' => 'add'];

        $formSubmitted = $_SERVER['REQUEST_METHOD'] == 'POST';

        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if ($formSubmitted) {
            $body = trim($_POST['body']);
            $title = trim($_POST['title']);

            if (empty($title)) {
                $data['title_error'] = 'Plase, inform the post title.';
            }

            if (empty($body)) {
                $data['body_error'] = 'Plase, share your thoughts with us.';
            }

            if (empty($data['body_error']) && empty($data['title_error'])) {

                $row = $this->postsModel->editPost($title, $body, $post_id);

                if ($row) {
                    flash('post_message', 'Post Updated!');
                    redirect('posts/show/' . $post_id);
                } else {
                    //Get existing post from model;
                    die('Something went wrong.');
                }
            }
        } else {
            $post = $this->postsModel->getPostById($post_id);

            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $post_id,
                'title' => $post->title,
                'body' => $post->body,
                'url' => 'edit',
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function show($post_id)
    {
        $post = $this->postsModel->getPostById($post_id);
        $user = $this->usersModel->getUserById($post->user_id);

        $data = ['url' => 'post', 'post' => $post, 'user' => $user];

        $this->view('posts/show', $data);
    }

    public function delete($post_id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->postsModel->deletePost($post_id);

            if ($result) {
                flash('post_message', 'Post deleted succesfully!', 'alert alert-danger');
                redirect('posts');
            } else {
                die('Something went wrong!');
            }
        }
    }

    public function like($post_id, $post_author_id)
    {
        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // $result = $this->postsModel->likePost($post_id, $user_id);
            die('here');
        }

        redirect('posts');
    }
}
