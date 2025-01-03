<?php

session_start();

$role = $_SESSION['role'];

if (!isset($role)) {
    header('Location: /blog/views/user/login.php');
    exit;
}

if ($role != 'writer' || $role != 'admin') {
    header('Location: /blog/views/user/dashboard.php');
    exit;
}

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/Post.php';
require_once __DIR__ . '/../../controllers/PostController.php';

use config\Database;
use models\Post;
use controllers\PostController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->getConnection();

    $post = new Post($db);
    $postController = new PostController($post);

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

    try {
        $postController->handlePostCreation($title, $body);
        header('Location: /blog/views/user/dashboard.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>Create Post</h1>
    <form method="post" action="create.php">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="body">Comment:</label>
        <input type="text" name="body" required><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
