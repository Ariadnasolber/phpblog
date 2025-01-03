CommentController.php 
 
<?php
 
namespace controllers;
 
use models\Comment;
 
class CommentController {
    private $commentModel;
 
    public function __construct(Comment $comment) {
        $this->commentModel = $comment;
    }
 
    // Crear un comentario
    public function createComment($post_id, $user_id, $content) {
        $this->commentModel->post_id = $post_id;
        $this->commentModel->user_id = $user_id;
        $this->commentModel->content = $content;
 
        if ($this->commentModel->create()) {
            echo "Comentario creado exitosamente.";
            return true;
        } else {
            echo "Error al crear el comentario.";
            return false;
        }
    }
 
    // Editar un comentario existente
    public function editComment($comment_id, $content) {
        $this->commentModel->id = $comment_id;
        $this->commentModel->content = $content;
 
        if ($this->commentModel->update()) {
            echo "Comentario editado exitosamente.";
            return true;
        } else {
            echo "Error al editar el comentario.";
            return false;
        }
    }
 
    // Eliminar un comentario (solo admins)
    public function deleteComment($comment_id, $isAdmin) {
        if ($isAdmin) {
            $this->commentModel->id = $comment_id;
 
            if ($this->commentModel->delete()) {
                echo "Comentario eliminado exitosamente.";
                return true;
            } else {
                echo "Error al eliminar el comentario.";
                return false;
            }
        } else {
            echo "No tienes permisos para eliminar este comentario.";
            return false;
        }
    }
 
    // Obtener todos los comentarios por ID de post
    public function getCommentsByPost($post_id) {
        $this->commentModel->post_id = $post_id;
        $stmt = $this->commentModel->readByPost();
 
        $comments = [];
        while ($row = $stmt->fetch()) {
            $comments[] = [
                'id' => $row['id'],
                'content' => $row['content'],
                'created_at' => $row['created_at'],
                'username' => $row['username'],
            ];
        }
        return $comments;
    }
}
?>
 
 