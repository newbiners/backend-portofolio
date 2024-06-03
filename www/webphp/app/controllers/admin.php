<?php
class Admin extends Controller
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode(array("message" => "admin"));
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                if (isset($data['username']) && isset($data['password'])) {

                    // Lanjutkan dengan proses login atau penyisipan data
                    $username = $data['username'];
                    $password = $data['password'];
                    $password_encript = password_hash($password, PASSWORD_DEFAULT);
                    $result = $this->model('Admin_model')->createAdmin($username, $password_encript);
                    if ($result) {
                        echo json_encode(array("message" => "success", "data" => "Admin created"));
                    } else {
                        echo json_encode(array("message" => "failed"));
                    }
                } else {
                    echo json_encode(array("message" => "failed no username or password"));
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
        }
    }

    public function login()
    {
        require_once __DIR__ . '/../core/JWTManager.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                if (isset($data['username']) && isset($data['password'])) {

                    $username = $data['username'] ?? '';
                    $password = $data['password'] ?? '';
                    $token = '';
                    $storedHashedPassword = $this->model('Admin_model')->getAdmin($username);
                    if (password_verify($password, $storedHashedPassword[0]['password'])) {
                        $secretKey = '23dsffsaqFFF';
                        $jwtManager = new JWTManager($secretKey);
                        $payload = array(
                            "password" => $storedHashedPassword[0]['password'],
                            "username" => $storedHashedPassword[0]['username']
                        );
                        $token = $jwtManager->createToken($payload);
                    } else {
                        echo json_encode(array("message" => "failed"));
                    }

                    echo json_encode(array("message" => "success", "token" => $token));
                } else {
                    echo json_encode(array("message" => "failed no username or password"));
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
        }
    }
}
