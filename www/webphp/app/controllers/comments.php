<?php

class Comments extends Controller{
    public function index(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode(array("message" => "commets"));
        }
    }

    public function get(){
        // Ambil dan sanitasi semua parameter dari URL
    
        

        try{
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $data_comments = $this->model('Comments_model')->getAll();
                $data = array();
                foreach ($data_comments as $comment) {
                    $user = $this->model('Users_model')->getById($comment['id_user']);
                    $data[] = array(
                        "id" => $comment['id'],
                        "name" => $user[0]['username'],
                        "comment" => $comment['comment']
                    );
                }
                echo json_encode(array("message" => "success", "data" => $data));
            }else {
                echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}