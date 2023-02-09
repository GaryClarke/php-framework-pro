<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';
$appEnv = 'prod';

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));

# services

$container->add(
    GaryClarke\Framework\Routing\RouterInterface::class,
    GaryClarke\Framework\Routing\Router::class
);

$container->extend(GaryClarke\Framework\Routing\RouterInterface::class)
    ->addMethodCall(
        'setRoutes',
        [new \League\Container\Argument\Literal\ArrayArgument($routes)]
    );

$container->add(GaryClarke\Framework\Http\Kernel::class)
    ->addArgument(GaryClarke\Framework\Routing\RouterInterface::class)
    ->addArgument($container);

return $container;

