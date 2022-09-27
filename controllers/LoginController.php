<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Application;
use momik\simplemvc\core\Controller;
use momik\simplemvc\core\facades\Session;
use momik\simplemvc\core\Request;
use momik\simplemvc\core\Response;
use momik\simplemvc\core\Validation;
use momik\simplemvc\core\View;

class LoginController extends Controller
{

    public array $params = [];

    /**
     * @return View
     */
    public function index(): View
    {
        return View::make('login', $this->params);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function login(Request $request, Response $response): View
    {
        $formFields = $request->getBody();

        $this->params['errors'] = Validation::validate($formFields);
        if ( !empty($this->params['errors']) ) {
            return View::make('login', $this->params);
        }

        $email    = $formFields['email'];
        $password = $formFields['password'];
        $user     = Application::$app->user;
        $result   = $user->findOne(array("email" => $email));

        if ( empty($result) ) {
            Session::setFlash('error', "Invalid email");

            return View::make('login', $this->params);
        }

        $user->initializeProperties($result);

        if ( !password_verify($password, $user->password) ) {
            Session::setFlash('error', "Invalid password");

            return View::make('login', $this->params);
        }

        Session::set('uid', $user->id);
        Session::set('firstname', $user->firstname);
        $response->redirect('profile');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function logout(Request $request, Response $response): void
    {
        Session::remove('uid');
        Session::remove('firstname');
        $response->redirect('/login');
    }


}