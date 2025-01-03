<?php
require 'db.php';

$stmt = $pdo->query("SELECT user_name, message, created_at FROM messages ORDER BY created_at ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($messages);
?>
