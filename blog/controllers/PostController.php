<?php

namespace controllers;

use models\Post;

class PostController {
    private $postModel;

    public function __construct(Post $post) {
        $this->postModel = $post;
    }

    public function handlePostCreation($title, $body) {
        $this->postModel->title = $title;
        $this->postModel->body = $body;

        if ($this->postModel->create()) {
            return true; // Retorna true si se crea correctamente
        } else {
            throw new Exception("Error al crear el post.");
        }
    }

    public function handleAllPostRead() {
        return $this->postModel->read();
    }
}
