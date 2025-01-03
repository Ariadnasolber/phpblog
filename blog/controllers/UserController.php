<?php

namespace controllers;

use models\User;

class UserController {
    private $userModel;

    public function __construct(User $user) {
        $this->userModel = $user;
    }

    public function handleRegistration($username, $email, $password) {
        $this->userModel->username = $username;
        $this->userModel->email = $email;
        $this->userModel->password = $password;

        if($this->userModel->register()) {
            echo "Registro exitoso";
        } else {
            echo "Error en el registro";
        }
    }

    public function handleLogin($username, $password) {
        $this->userModel->username = $username;
        $this->userModel->password = $password;
    
        if ($this->userModel->login()) { // Este método debería devolver true o false
            session_start();
            $_SESSION['user_id'] = $this->userModel->id;
            $_SESSION['username'] = $this->userModel->username;
            $_SESSION['role'] = $this->userModel->role;
    
            echo "Inicio de sesión exitoso"; // Mensaje positivo
            return true;
        } else {
            echo "Nombre de usuario o contraseña incorrectos"; // Mensaje negativo
            return false;
        }
    }
    
    public function handleLogout() {
        session_unset();
        session_destroy();
        echo "Sesión cerrada exitosamente";
        return true;
    }

}