<?php

namespace momik\simplemvc\controllers;

use momik\simplemvc\core\Controller;

class SiteController extends Controller
{

    public function home(): bool | array | string
    {
        $params = [
            'name' => "momik"
        ];

        return $this->render('home', $params);
    }

    /**
     * @return bool|array|string
     */
    public function contact(): bool | array | string
    {
        $params = [];

        return $this->render('contact', $params);
    }

}