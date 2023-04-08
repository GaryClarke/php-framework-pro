<?php

namespace GaryClarke\Framework\Http\Middleware;

use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;
use GaryClarke\Framework\Session\SessionInterface;

class StartSession implements MiddlewareInterface
{
    public function __construct(
        private SessionInterface $session,
        private string $apiPrefix = '/api/'
    )
    {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        if (!str_starts_with($request->getPathInfo(), $this->apiPrefix)) {
            $this->session->start();

            $request->setSession($this->session);
        }

        return $requestHandler->handle($request);
    }
}







