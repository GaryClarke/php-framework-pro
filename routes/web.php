<?php

use GaryClarke\Framework\Http\Response;

return [
    ['GET', '/', [\App\Controller\HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [\App\Controller\PostsController::class, 'show']],
    ['GET', '/posts', [\App\Controller\PostsController::class, 'create']],
    ['GET', '/hello/{name:.+}', function(string $name) {
        return new Response("Hello $name");
    }]
];

