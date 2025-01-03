<?php
session_start();

use config\Database;
use controllers\PostController;
use models\Post;
 
require_once '../../config/Database.php';
require_once '../../models/Post.php';
require_once '../../controllers/PostController.php';
 
// Instanciar base de datos, modelo y controlador
$database = new Database();
$db = $database->getConnection();
$postModel = new Post($db);
$postController = new PostController($postModel);

$posts = $postController->handleAllPostRead();



/*

<!-- HTML del Post -->
<h1>Detalles del Post</h1>
<h2><?php echo $posts; ?></h2>
 
<!-- Formulario para enviar comentarios -->
<h3>Deja un comentario</h3>
<form method="POST">
    <textarea name="content" rows="4" cols="50" placeholder="Escribe tu comentario aquí"></textarea><br>
    <button type="submit">Enviar</button>
</form>
 
<!-- Lista de Comentarios -->
<h3>Comentarios</h3>
<?php

<?php if (empty($comments)): ?>
    <p>No hay comentarios aún.</p>
<?php else: ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                <?php echo htmlspecialchars($comment['content']); ?>
                <br>
                <small><?php echo $comment['created_at']; ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
 
*/
?>