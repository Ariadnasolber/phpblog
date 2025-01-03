<?php
$host = 'localhost'; // Cambia esto según tu configuración
$dbname = 'nombre_de_tu_bd';
$username = 'usuario_bd';
$password = 'contraseña_bd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
