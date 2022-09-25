<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return bool|array|string
     */
    public function login(Request $request): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            return "Processing login thingy";
        }
        $this->setLayout('auth');

        return $this->render('login', $params);
    }

    /**
     * @param Request $request
     * @return bool|array|string
     */
    public function register(Request $request): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            $user = new User();
            $user->fillProperties($request->getBody());
            if ($user->register()) {
                Application::$app->session->setFlash('success', 'Success jula');
                Application::$app->response->redirect('/register');
            }
        }
        $this->setLayout('auth');

        return $this->render('register', $params);
    }
}