<?php

class Pages extends Controller
{
    private $postModel;

    public function __construct()
    {
        //echo "Pages loaded";
    }

    public function index()
    {
        $data = ['title' => 'Welcome', 'url' => 'home', 'description' => 'Simple social network built on the MVC framework.'];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'About page', 'url' => 'about', 'description' => 'App to share posts with other users.'];
        $this->view('pages/about', $data);
    }
}
