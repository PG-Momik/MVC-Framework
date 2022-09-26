<?php

namespace app\controllers;

use momik\simplemvc\Controller;
use momik\simplemvc\Request;

class SiteController extends Controller
{
    public function home(): bool|array|string
    {
        $params = [
            'name' => "momik"
        ];

        return $this->render('home', $params);
    }

    /**
     * @return bool|array|string
     */
    public function contact(): bool|array|string
    {
        $params = [];

        return $this->render('contact', $params);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function handleContact(Request $request): string
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";

        return "handle";
    }
}