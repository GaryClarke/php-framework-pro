<?php

namespace GaryClarke\Framework\Http\Middleware;

use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;
use GaryClarke\Framework\Http\TokenMismatchException;

class VerifyCsrfToken implements MiddlewareInterface
{
    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        // Proceed if not state change request
        if (!in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return $requestHandler->handle($request);
        }

        // Retrieve the tokens
        $tokenFromSession = $request->getSession()->get('csrf_token');
        //$tokenFromRequest = $request->input('_token');
        $tokenFromRequest = 'fake-token';

        // Throw an exception on mismatch
        if(!hash_equals($tokenFromSession, $tokenFromRequest)) {
            // Throw an exception
            $exception = new TokenMismatchException('Your request could not be validated. Please try again');
            $exception->setStatusCode(Response::HTTP_FORBIDDEN);
            throw $exception;
        }

        // Proceed
        return $requestHandler->handle($request);
    }
}