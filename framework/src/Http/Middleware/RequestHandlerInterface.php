<?php

namespace GaryClarke\Framework\Http\Middleware;

use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;

interface RequestHandlerInterface
{
    public function handle(Request $request): Response;
}