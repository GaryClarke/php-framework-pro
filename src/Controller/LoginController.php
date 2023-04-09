<?php

namespace App\Controller;

use GaryClarke\Framework\Authentication\SessionAuthentication;
use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Response;

class LoginController extends AbstractController
{
    public function __construct(private SessionAuthentication $authComponent)
    {
    }

    public function index(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login(): Response
    {
        // Attempt to authenticate the user using a security component (bool)
        // create a session for the user
        $userIsAuthenticated = $this->authComponent->authenticate(
            $this->request->input('username'),
            $this->request->input('password')
        );

        // If successful, retrieve the user

        // Redirect the user to intended location
    }
}