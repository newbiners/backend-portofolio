<?php
class Film_model {
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
        $stmt = $this->db->prepare("SELECT * FROM film");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function deleteData($id) {
        $stmt = $this->db->prepare("DELETE FROM film WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function createData($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO film (title, genre, img, video) VALUES (:title, :genre, :img, :video)");
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':genre', $data['genre']);
            $stmt->bindParam(':img', $data['img']);
            $stmt->bindParam(':video', $data['video']);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Tangkap error dan kembalikan false
            return false;
        }
    }
}
?>
