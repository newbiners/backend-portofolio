<?php
class User extends Controller{
    public function index(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode(array("message" => "users"));
        }
    }

    public function getAll() {
        require_once __DIR__ . '/../core/JWTManager.php';
        if($_SERVER['REQUEST_METHOD'] === 'GET') { 
            try {
                $headers = getallheaders();
                if(isset($headers)) {
                    $headerAuth = $headers['Authorization'];
                    $secretKey = '23dsffsaqFFF';
                    $jwtManager = new JWTManager($secretKey);
                    $data = $jwtManager->validateToken($headerAuth);
                    echo json_encode(array("message" => "success", "data" => $data));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Header Authorization tidak ditemukan."));
                }
            } catch(Exception $e) {
                echo json_encode(array("status" => "error", "message" => $e->getMessage()));
            }
            
            // echo json_encode(array("message" => "success", "data" => $data));
         }else {
            echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
         }
    }
}