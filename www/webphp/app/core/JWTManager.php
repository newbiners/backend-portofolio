<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JWTManager
{
    private $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    // Membuat token JWT
    public function createToken($payload)
    {
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    // Memvalidasi token JWT
    public function validateToken($token)
    {
        try {
            // Dekode token menggunakan algoritma yang ditetapkan dalam properti algorithm
            $decoded = JWT::decode($token,new key($this->secretKey, "HS256"));
    
            // Kembalikan payload yang telah didekode
            return $decoded;
        } catch (Exception $e) {
            // Tangani kesalahan jika terjadi dan kembalikan pesan kesalahan
            return false;
        }
    }
    
    

}

?>
