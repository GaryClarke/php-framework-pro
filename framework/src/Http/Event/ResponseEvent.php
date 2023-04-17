<?php

namespace GaryClarke\Framework\Http\Event;

use GaryClarke\Framework\EventDispatcher\Event;
use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;

class ResponseEvent extends Event
{
    public function __construct(
        private Request $request,
        private Response $response
    )
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}