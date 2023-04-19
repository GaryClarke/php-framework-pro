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
            // Break if propagation stopped

            // Call the listener, passing in the event (each listener will be a callable)
            $listener($event);
        }

    }

    // $eventName e.g. Framework\EventDispatcher\ResponseEvent
    public function addListener(string $eventName, callable $listener): self
    {
        $this->listeners[$eventName][] = $listener;

        return $this;
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
        $eventName = get_class($event);

        if (array_key_exists($eventName, $this->listeners)) {
            return $this->listeners[$eventName];
        }

        return [];
    }
}