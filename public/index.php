<?php declare(strict_types=1);

use GaryClarke\Framework\Http\Kernel;
use GaryClarke\Framework\Http\Request;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$container = require BASE_PATH . '/config/services.php';

// request received
$request = Request::createFromGlobals();

// perform some logic
$kernel = $container->get(Kernel::class);

// send response (string of content)
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);