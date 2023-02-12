<?php

namespace App\Controller;

use App\Widget;
use GaryClarke\Framework\Http\Response;
use Twig\Environment;

class HomeController
{
    public function __construct(private Widget $widget, private Environment $twig)
    {
    }

    public function index(): Response
    {
        dd($this->twig);

        $content = "<h1>Hello {$this->widget->name}</h1>";

        return new Response($content);
    }
}