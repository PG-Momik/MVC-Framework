<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login(Request $request): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            return "Processing login thingy";
        }

        return $this->render('login', $params);
    }

    public function register(Request $request): bool|array|string
    {
        $params = [];
        if ($request->isPost()) {
            return "Processing register thingy";
        }

        return $this->render('register', $params);
    }
}