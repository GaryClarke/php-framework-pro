<?php

namespace App\Controller;

use GaryClarke\Framework\Http\Response;

class PostsController
{
    public function show(int $id): Response
    {
        $content = "This is post $id";

        return new Response($content);
    }
}