<?php
class Comment {
    private $conn;
    private $table = 'comments';
 
    public $id;
    public $post_id;
    public $user_id;
    public $content;
    public $created_at;
 
    public function __construct($db) {
        $this->conn = $db;
    }
 
    // Crear un nuevo comentario
    public function create() {
        $query = "INSERT INTO " . $this->table . " (post_id, user_id, content, created_at) VALUES (:post_id, :user_id, :content, NOW())";
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':content', $this->content);
 
        return $stmt->execute();
    }
 
    // Obtener comentarios por ID de post
    public function readByPost() {
        $query = "SELECT c.id, c.content, c.created_at, u.username FROM " . $this->table . " c
                  JOIN users u ON c.user_id = u.id
                  WHERE c.post_id = :post_id ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->execute();
        return $stmt;
    }
}
?>