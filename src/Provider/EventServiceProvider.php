<?php

namespace App\Provider;

use App\EventListener\ContentLengthListener;
use App\EventListener\InternalErrorListener;
use GaryClarke\Framework\Dbal\Event\PostPersist;
use GaryClarke\Framework\EventDispatcher\EventDispatcher;
use GaryClarke\Framework\Http\Event\ResponseEvent;
use GaryClarke\Framework\ServiceProvider\ServiceProviderInterface;

class EventServiceProvider implements ServiceProviderInterface
{
    private array $listen = [
        ResponseEvent::class => [
            InternalErrorListener::class,
            ContentLengthListener::class
        ],
        PostPersist::class => [
        ]
    ];

    public function __construct(private EventDispatcher $eventDispatcher)
    {
    }

    public function register(): void
    {
        // loop over each event in the listen array
        foreach ($this->listen as $eventName => $listeners) {
            // loop over each listener
            foreach (array_unique($listeners) as $listener) {
                // call eventDispatcher->addListener
                $this->eventDispatcher->addListener($eventName, new $listener());
            }
        }
    }
}