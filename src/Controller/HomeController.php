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
        return $this->render('home.html.twig');
    }
}