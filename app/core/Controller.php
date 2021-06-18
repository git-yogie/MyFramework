<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function views($view, $data = [], $header = null, $footer = null)
    {
        require_once '../app/views/' . $header . '.php';
        require_once '../app/views/' . $view . '.php';
        require_once '../app/views/' . $footer . '.php';
    }

    public function Model($model){
        require_once '../app/models/'.$model.'.php';
        return new $model;
    }

    public function Library($library){
        require_once '../app/models/'.$library.'.php';
        return new $library;
    }
}
