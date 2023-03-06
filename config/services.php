<?php

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(BASE_PATH . '/.env');

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';
$appEnv = $_SERVER['APP_ENV'];
$templatesPath = BASE_PATH . '/templates';

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));
$databaseUrl = 'sqlite:///' . BASE_PATH . '/var/db.sqlite';

$container->add(
    'base-commands-namespace',
    new \League\Container\Argument\Literal\StringArgument('GaryClarke\\Framework\\Console\\Command\\')
);

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

$container->add(\GaryClarke\Framework\Console\Application::class)
    ->addArgument($container);

$container->add(\GaryClarke\Framework\Console\Kernel::class)
    ->addArguments([$container, \GaryClarke\Framework\Console\Application::class]);

$container->addShared('filesystem-loader', \Twig\Loader\FilesystemLoader::class)
    ->addArgument(new \League\Container\Argument\Literal\StringArgument($templatesPath));

$container->addShared('twig', \Twig\Environment::class)
    ->addArgument('filesystem-loader');

$container->add(\GaryClarke\Framework\Controller\AbstractController::class);

$container->inflector(\GaryClarke\Framework\Controller\AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(\GaryClarke\Framework\Dbal\ConnectionFactory::class)
    ->addArguments([
        new \League\Container\Argument\Literal\StringArgument($databaseUrl)
    ]);

$container->addShared(\Doctrine\DBAL\Connection::class, function () use ($container): \Doctrine\DBAL\Connection {
    return $container->get(\GaryClarke\Framework\Dbal\ConnectionFactory::class)->create();
});

return $container;

