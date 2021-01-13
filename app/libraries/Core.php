<?php
/*
    * APP CORE CLASS
    * - Creates URL & Loads core controller
    * - URL FORMAT -/controller/method/params
    */

class Core
{
    // Page par defaut
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();
        //LOOK IN CONTROLLERS FOR first value 'mypage/[post]/edit'
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
        }


        //REQUIRE THE CONTROLLER
        require_once '../app/controllers/' . $this->currentController . '.php';

        // INSTANTIATE CONTROLLER CLASS
        $this->currentController = new $this->currentController;

        // CHECK FOR SECOND PART OF URL
        if (isset($url[1])) {
            // check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                //unset 1 index
                unset($url[1]);
            }
        }

        // GET PARAMS
        $this->params = $url ? array_values($url) : [];

        // CAll a callback of array of params
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
