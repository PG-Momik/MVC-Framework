<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Application;
use momik\simplemvc\core\Controller;
use momik\simplemvc\core\View;

class ProfileController extends Controller
{

    public array $params = [];

    /**
     * @return View
     */
    public function index(): View
    {
        $user         = Application::$app->user;
        $user->id     = Application::$app->session->get('uid');
        $this->params = $user->findOne(array('id' => $user->id));

        return View::make('profile', $this->params);
    }


}