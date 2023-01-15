<?php declare(strict_types=1);

use GaryClarke\Framework\Http\Kernel;
use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// request received
$request = Request::createFromGlobals();

// perform some logic
$kernel = new Kernel();

// send response (string of content)
$response = $kernel->handle($request);

$response->send();

