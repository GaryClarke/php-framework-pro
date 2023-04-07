<?php

namespace App\Controller;

use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Response;

class RegistrationController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('register.html.twig');
    }
}