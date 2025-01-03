<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../controllers/UserController.php';

use config\Database;
use models\User;
use controllers\UserController;

session_start(); // Asegúrate de que la sesión esté iniciada

$db = (new Database())->getConnection();

$user = new User($db);
$userController = new UserController($user);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $userController->handleLogout();
    header('Location: /blog/index.php');
    exit();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h4>Está seguro que desea cerrar sesión?</h4>
    <form method="post" action="logout.php">
        <button type="submit" name="logout">Cerrar sesión</button>
    </form>
</body>
</html>