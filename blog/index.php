<?php
session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido <?php if (isset($username)) echo $username; else echo "a nuestro blog"; ?></h1>
    <h4>Si no tiene una cuenta creela aquí: <a href="/blog/views/user/register.php">Registrarse</a></h4>
    <h4>Si ya tiene una cuenta inicie sesión aquí: <a href="/blog/views/user/login.php">Iniciar sesión</a></h4>
    <h4>Para crear un blog vaya a la siguiente página <a href="/blog/views/post/create.php">Crear blog</a></h4>
    <h4>Para cerrar sesión vaya a <a href="/blog/views/user/logout.php">Log out</a></h4>
    <h4>Para ir al menu principal vaya a <a href="/blog/views/user/dashboard.php">Dashboard</a></h4>
</body>
</html>