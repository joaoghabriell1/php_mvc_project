<?php

/* 
        * App Core Classa
        * Creates URL & loads core controller
        * URL FORMAT - /controller/method/params
    */


class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());

        $url = $this->getUrl();
        $url_controller = isset($url[0]) ? ucwords($url[0]) : null;

        //Look in controllers for first value

        if (file_exists('../app/controllers/' . $url_controller . '.php')) {
            // if exists, set as controller
            //ucwords capitalizes the first letter of a string
            $this->currentController = $url_controller;

            //Unset 0 Index (removes the first element and shifts down the rest of the elments)
            unset($url[0]);
        }

        // Require the controller so it can be instanciated

        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class

        $this->currentController = new $this->currentController();

        //Check for second part of url

        if (isset($url[1])) {
            //Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //Get params
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
