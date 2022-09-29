<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Controller;
use momik\simplemvc\core\Request;
use momik\simplemvc\core\View;

/**
 *
 */
class HomeController extends Controller
{
    public array $params = [];

    /**
     * @return View
     */
    public function index(): View
    {
        return View::make('home', $this->params);
    }


}