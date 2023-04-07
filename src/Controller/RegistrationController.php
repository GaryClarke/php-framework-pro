<?php

namespace App\Controller;

use App\Form\User\RegistrationForm;
use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Response;

class RegistrationController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('register.html.twig');
    }

    public function register(): Response
    {
        // Create a form model which will:
        // - validate fields
        // - map the fields to User object properties
        // - ultimately save the new User to the DB
        $form = new RegistrationForm();
        $form->setFields(
            $this->request->input('username'),
            $this->request->input('password')
        );

        // Validate
        // If validation errors,
        if ($form->hasValidationErrors()) {
            dd($form->getValidationErrors());
        }
        // add to session, redirect to form

        // register the user by calling $form->save()

        // Add a session success message

        // Log the user in

        // Redirect to somewhere useful
    }
}