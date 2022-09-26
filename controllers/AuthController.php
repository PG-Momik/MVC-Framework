<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Application;
use momik\simplemvc\core\Controller;
use momik\simplemvc\core\Request;
use momik\simplemvc\core\Response;
use momik\simplemvc\models\LoginForm;
use momik\simplemvc\models\User;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return bool|array|string
     */
    public function login(Request $request, Response $response): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            $loginForm = new LoginForm();
            $email = $request->getBody()['email'];
            $password = $request->getBody()['password'];
            $user = Application::$app->user;
            $user->fillProperties($loginForm->findOne(array("email" => $email)));
            if (empty($user)) {
                Application::$app->session->setFlash('error', "User not found.");
                $response->redirect('/login');
            }
            if (!password_verify($password, $user->password)) {
                Application::$app->session->setFlash('error', "Password not match");
                $response->redirect('/login');
            }
            Application::$app->user = $user;
            Application::$app->session->set('uid', $user->id);
            Application::$app->session->set('uname', $user->firstname);
            Application::$app->isGuest = false;
            $response->redirect('/profile');
        }
        $this->setLayout('auth');

        return $this->render('login', $params);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return bool|array|string
     */
    public function register(Request $request, Response $response): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            $user = new User();
            $hash = password_hash($request->getBody()['password'], PASSWORD_DEFAULT);
            echo "<pre>";
            $request->set('password', $hash);
            $user->fillProperties($request->getBody());
            if ($user->register()) {
                Application::$app->session->setFlash('success', 'Success jula');
                $response->redirect('/register');
            }
        }
        $this->setLayout('auth');

        return $this->render('register', $params);
    }

    /**
     * @return bool|array|string
     */
    public function profile(): bool|array|string
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
        Application::$app->isGuest = true;
        Application::$app->response->redirect('/');
    }
}