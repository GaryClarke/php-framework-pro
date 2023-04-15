<?php

use GaryClarke\Framework\Http\Response;

return [
    ['GET', '/', [\App\Controller\HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [\App\Controller\PostsController::class, 'show']],
    ['GET', '/posts', [\App\Controller\PostsController::class, 'create']],
    ['POST', '/posts', [\App\Controller\PostsController::class, 'store']],
    ['GET', '/register', [\App\Controller\RegistrationController::class, 'index',
        [
            \GaryClarke\Framework\Http\Middleware\Guest::class
        ]
    ]
    ],
    ['POST', '/register', [\App\Controller\RegistrationController::class, 'register']],
    ['GET', '/login', [\App\Controller\LoginController::class, 'index',
        [
            \GaryClarke\Framework\Http\Middleware\Guest::class
        ]
    ]
    ],
    ['POST', '/login', [\App\Controller\LoginController::class, 'login']],
    ['GET', '/dashboard', [\App\Controller\DashboardController::class, 'index',
        [
            \GaryClarke\Framework\Http\Middleware\Authenticate::class,
            \GaryClarke\Framework\Http\Middleware\Dummy::class
        ]
    ]
    ],
    ['GET', '/hello/{name:.+}', function(string $name) {
        return new Response("Hello $name");
    }]
];

