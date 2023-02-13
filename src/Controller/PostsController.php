<?php

namespace App\Controller;

use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Response;

class PostsController extends AbstractController
{
    public function show(int $id): Response
    {
        return $this->render('posts.html.twig', [
            'postId' => $id
        ]);
    }
}