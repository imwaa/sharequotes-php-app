<?php

/* 
* BASE CONTROLLER
* LOADS THE MODELS AND VIEWS
*/

class Controller
{
    // Load Model
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';

        //Instatiante model
        return new $model();
    }

    // Load View
    public function  view($view, $data = []){
        // check for view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            // view does not exists
            die('View does not exist');
        }

    }
}
