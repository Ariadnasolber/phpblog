<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../controllers/UserController.php';

use config\Database;
use models\User;
use controllers\UserController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = (new Database())->getConnection();
    $user = new User($db);
    $userController = new UserController($user);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController->handleRegistration($username, $email, $password);
    header('Location: login.php');
    exit;
}

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <label for="username">Nombre de usuario: </label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>