<?php

$container = new \League\Container\Container();

$container->add(
    GaryClarke\Framework\Routing\RouterInterface::class,
    GaryClarke\Framework\Routing\Router::class
);

$container->add(GaryClarke\Framework\Http\Kernel::class)
    ->addArgument(GaryClarke\Framework\Routing\RouterInterface::class);

return $container;

