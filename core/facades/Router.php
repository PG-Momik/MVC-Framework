<?php

namespace momik\simplemvc\core\facades;

use momik\simplemvc\core\Application;

class Router
{

    /**
     * @param $url
     * @param $array
     * @return void
     */
    public static function GET($url, $array): void
    {
        Application::$app->router->get($url, $array);
    }

    /**
     * @param $url
     * @param $array
     * @return void
     */
    public static function POST($url, $array): void
    {
        Application::$app->router->post($url, $array);
    }

}