<?php

namespace GaryClarke\Framework\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    private iterable $listeners = [];

    public function dispatch(object $event)
    {
        // Loop over the listeners for the event
        foreach ($this->getListenersForEvent($event) as $listener) {
            // Call the listener, passing in the event (each listener will be a callable)
            $listener($event);
        }

    }

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable<callable>
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event) : iterable
    {
        //
    }
}