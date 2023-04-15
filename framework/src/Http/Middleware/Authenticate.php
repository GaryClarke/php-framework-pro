<?php

namespace GaryClarke\Framework\Http\Middleware;

use GaryClarke\Framework\Authentication\SessionAuthentication;
use GaryClarke\Framework\Http\RedirectResponse;
use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;
use GaryClarke\Framework\Session\Session;
use GaryClarke\Framework\Session\SessionInterface;

class Authenticate implements MiddlewareInterface
{
    public function __construct(private SessionInterface $session)
    {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        $this->session->start();

        if (!$this->session->has(Session::AUTH_KEY)) {
            $this->session->setFlash('error', 'Please sign in');
            return new RedirectResponse('/login');
        }

        return $requestHandler->handle($request);
    }
}







