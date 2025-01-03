<?php

namespace models;

use PDO;

class Post {
    private $conn;
    private $table_name = 'posts';

    public $id;
    public $title;
    public $content;
    public $created_at;
    public $modified_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo post
    public function create() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /blog/views/user/login.php');
            exit;
        }

        $this->id = $_SESSION['user_id'];

        $query = "INSERT INTO " . $this->table_name . " (user_id, title, content) VALUES (:user_id, :title, :content)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar entradas
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bindeo de parámetros
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Leer todos los posts
    public function read() {
        $query = "SELECT id, title, content, created_at, modified_at FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    // Leer un post por ID
    public function readSingle() {
        $query = "SELECT id, title, content, created_at, modified_at FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar y bindeo de ID
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un post
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar entradas
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bindeo de parámetros
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Eliminar un post
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar y bindeo de ID
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
