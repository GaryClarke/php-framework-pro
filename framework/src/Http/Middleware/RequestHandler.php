<?php

namespace GaryClarke\Framework\Http\Middleware;

use GaryClarke\Framework\Container\Container;
use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;
use Psr\Container\ContainerInterface;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [
        ExtractRouteInfo::class,
        StartSession::class,
        Authenticate::class,
        RouterDispatch::class
    ];

    public function __construct(private ContainerInterface $container)
    {
    }

    public function handle(Request $request): Response
    {
        // If there are no middleware classes to execute, return a default response
        // A response should have been returned before the list becomes empty
        if (empty($this->middleware)) {
            return new Response("It's totally borked, mate. Contact support", 500);
        }

        // Get the next middleware class to execute
        $middlewareClass = array_shift($this->middleware);

        $middleware = $this->container->get($middlewareClass);

        // Create a new instance of the middleware call process on it
        $response = $middleware->process($request, $this);

        return $response;
    }
}







