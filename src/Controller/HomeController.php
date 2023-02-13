<?php

namespace App\Controller;

use App\Widget;
use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index(): Response
    {
        dd($this->container->get('twig'));

        $content = "<h1>Hello {$this->widget->name}</h1>";

        return new Response($content);
    }
}