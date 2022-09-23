<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home(): bool|array|string
    {
        $params = [
            'name' => "momik"
        ];

        return $this->render('home', $params);
    }

    public function contact(): bool|array|string
    {
        $params = [];

        return $this->render('contact', $params);
    }

    public function handleContact(Request $request): string
    {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "</pre>";

        return "handle";
    }
}