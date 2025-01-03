<?php

namespace models;

use PDO;

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role; // Por defecto subscriber

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para registrar usuarios nuevos a la base de datos
    public function register() {
        // Preparamos la sentencia SQL 
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";

        $stmt = $this->conn->prepare($query);

        // Limpiamos los datos introducidos para evitar SQL injection
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $hashed_passwrord = password_hash($this->password, PASSWORD_DEFAULT);

        // Bindeamos parámetros y hasheamos la contraseña
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $thid->hashed_password);

        // Si la ejecución es exitosa devolvemos true, en caso contrario false
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $query = "SELECT id, username, password, role FROM " . $this->table_name . " WHERE username = :username";

        $stmt = $this->conn->prepare($query);

        // hace falta en id ?
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        
        $stmt->bindParam(':username', $this->username);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->role = $row['role'];
                return true;
            }
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM $this->table_name WHERE $this->id = id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}