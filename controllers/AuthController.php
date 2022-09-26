<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Application;
use momik\simplemvc\core\Controller;
use momik\simplemvc\core\Request;
use momik\simplemvc\core\Response;
use momik\simplemvc\models\User;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @param Response $response
     * @return bool|array|string
     */
    public function login(Request $request, Response $response): bool | array | string
    {
        $params = [];
        $this->setLayout('auth');

        if ( $request->isPost() ) {
            $email    = $request->get('email');
            $password = $request->get('password');
            $password = password_hash($password, PASSWORD_DEFAULT);

            $user   = Application::$app->user;
            $result = $user->findOne(array('email' => $email));

            if ( empty($result) ) {
                Application::$app->session->setFlash('error', "User not found.");
                $response->redirect('/login');
            }

            $user->initializeProperties($result);

            if ( !password_verify($user->password, $password) ) {
                Application::$app->session->setFlash('error', "Password not match");
                $response->redirect('/login');
            }

            Application::$app->user = $user;
            Application::$app->session->set('uid', $user->id);
            Application::$app->session->set('uname', $user->firstname);
            Application::$app->session->setFlash('error', "Invalid credentials");
        }

        return $this->render('/login', $params);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string|array|bool
     */
    public function register(Request $request, Response $response): string | array | bool
    {
        $params = [];
        $this->setLayout('auth');

        if ( $request->isPost() ) {
            $password = $request->get('password');
            $password = password_hash($password, PASSWORD_DEFAULT);
            $request->set('password', $password);

            $user = new User();
            $user->initializeProperties($request->getBody());

            if ( $user->register() ) {
                Application::$app->session->setFlash('success', 'Success jula');
                $response->redirect('/register');
            }
        }

        return $this->render('register', $params);
    }

    /**
     * @return bool|array|string
     */
    public function profile(): bool | array | string
    {
        return $this->render('profile', []);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Application::$app->session->remove('uid');
        Application::$app->session->remove('uname');
        Application::$app->response->redirect('/');
    }

}