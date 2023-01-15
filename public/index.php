<?php declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

// request received
$request = \GaryClarke\Framework\Http\Request::createFromGlobals();

dd($request);

// perform some logic

// send response (string of content)
echo 'Hello World';

