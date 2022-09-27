<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Application;
use momik\simplemvc\core\Controller;
use momik\simplemvc\core\Request;
use momik\simplemvc\core\Response;
use momik\simplemvc\core\Validation;
use momik\simplemvc\core\View;

class RegisterController extends Controller
{

    public array $params = [];

    /**
     * @return View
     */
    public function index(): View
    {
        return View::make('register', $this->params);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function register(Request $request, Response $response): View
    {
        $user       = Application::$app->user;
        $formFields = $request->getBody();

        $this->params['errors'] = Validation::validate($formFields);
        if ( !empty($this->params['errors']) ) {
            return View::make('register', $this->params);
        }

        $user->initializeProperties($formFields);
        $user->password = password_hash($user->password, PASSWORD_DEFAULT);

        $user->save() ? $this->params['success'] = "Registration Successful" : $this->params['error'] = "Registration Unsuccessful.";

        return View::make('register', $this->params);
    }


}