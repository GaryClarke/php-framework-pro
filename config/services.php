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

$container->add(
    \GaryClarke\Framework\Http\Middleware\RequestHandlerInterface::class,
    \GaryClarke\Framework\Http\Middleware\RequestHandler::class
)->addArgument($container);

$container->add(GaryClarke\Framework\Http\Kernel::class)
    ->addArguments([
        GaryClarke\Framework\Routing\RouterInterface::class,
        $container,
        \GaryClarke\Framework\Http\Middleware\RequestHandlerInterface::class
    ]);

$container->add(\GaryClarke\Framework\Console\Application::class)
    ->addArgument($container);

$container->add(\GaryClarke\Framework\Console\Kernel::class)
    ->addArguments([$container, \GaryClarke\Framework\Console\Application::class]);

$container->addShared(
    \GaryClarke\Framework\Session\SessionInterface::class,
    \GaryClarke\Framework\Session\Session::class
);

$container->add('template-renderer-factory', \GaryClarke\Framework\Template\TwigFactory::class)
    ->addArguments([
        \GaryClarke\Framework\Session\SessionInterface::class,
        new \League\Container\Argument\Literal\StringArgument($templatesPath)
    ]);

$container->addShared('twig', function () use ($container) {
    return $container->get('template-renderer-factory')->create();
});

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

$container->add(
    'database:migrations:migrate',
    \GaryClarke\Framework\Console\Command\MigrateDatabase::class
)->addArguments([
    \Doctrine\DBAL\Connection::class,
    new \League\Container\Argument\Literal\StringArgument(BASE_PATH . '/migrations')
]);

$container->add(\GaryClarke\Framework\Http\Middleware\RouterDispatch::class)
    ->addArguments([
        \GaryClarke\Framework\Routing\RouterInterface::class,
        $container
    ]);

$container->add(\GaryClarke\Framework\Authentication\SessionAuthentication::class)
    ->addArgument(\App\Repository\UserRepository::class);

return $container;

