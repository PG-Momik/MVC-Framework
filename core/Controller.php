<?php

namespace app\core;

class Controller
{
    /**
     * @param string $view
     * @param array $params
     * @return string|array|bool
     */
    public function render(string $view, array $params): string|array|bool
    {
        return Application::$app->router->renderView($view, $params);
    }
}