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
        $template = "<h1>Hello {{ name }}</h1>";

        return $this->render($template, [
            'name' => $this->widget->name
        ]);
    }
}