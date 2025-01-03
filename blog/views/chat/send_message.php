<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $message = $_POST['message'];

    if (!empty($user_name) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_name, message) VALUES (:user_name, :message)");
        $stmt->execute([
            ':user_name' => $user_name,
            ':message' => $message
        ]);
        echo "Mensaje enviado.";
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>
