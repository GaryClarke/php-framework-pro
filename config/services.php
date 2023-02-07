<?php

$container = new \League\Container\Container();

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';

# services

$container->add(
    GaryClarke\Framework\Routing\RouterInterface::class,
    GaryClarke\Framework\Routing\Router::class
);

$container->add(GaryClarke\Framework\Http\Kernel::class)
    ->addArgument(GaryClarke\Framework\Routing\RouterInterface::class);

return $container;

