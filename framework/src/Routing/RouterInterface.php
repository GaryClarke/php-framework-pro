<?php

namespace GaryClarke\Framework\Routing;

use GaryClarke\Framework\Http\Request;
use Psr\Container\ContainerInterface;

interface RouterInterface
{
    public function dispatch(Request $request, ContainerInterface $container);
}