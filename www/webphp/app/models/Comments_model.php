<?php 
class Comments_model{
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

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM comments");
        // $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        // $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>