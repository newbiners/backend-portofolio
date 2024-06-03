<?php
class Admin_model{
    private $db;
    public function __construct() {
        $dsn = 'mysql:host='. getenv('HOST_NAME') . ';dbname='. getenv('DATA_BASE');
        try {
            $this->db = new PDO($dsn, getenv('USER_NAME'), getenv('PASSWORD'));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAdmin($username) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE username =  :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAdmin($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}