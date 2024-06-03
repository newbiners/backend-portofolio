<?php

class Controller{
    public function view($url, $data = [] ){
        require_once '../app/views/'.$url.'.php';
    }

    public function model($model){
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }
}