<?php

namespace GaryClarke\Framework\Routing;

use GaryClarke\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}