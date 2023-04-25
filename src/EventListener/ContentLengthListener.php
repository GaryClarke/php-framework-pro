<?php

namespace App\EventListener;

use GaryClarke\Framework\Http\Event\ResponseEvent;

class ContentLengthListener
{
    public function __invoke(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        if (!array_key_exists('Content-Length', $response->getHeaders())) {
            $response->setHeader('Content-Length', strlen($response->getContent()));
        }

        dd('You got here!');
    }
}