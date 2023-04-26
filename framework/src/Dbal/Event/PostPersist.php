<?php

namespace GaryClarke\Framework\Dbal\Event;

use GaryClarke\Framework\Dbal\Entity;
use GaryClarke\Framework\EventDispatcher\Event;

class PostPersist extends Event
{
    public function __construct(private Entity $subject)
    {
    }
}