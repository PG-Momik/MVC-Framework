<?php

namespace app\core;

class Controller
{
    /**
     * @param string $view
     * @param array $params
     * @return string|array|bool
     */
    public string $layout = 'main';

    public function render(string $view, array $params): string|array|bool
    {
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * @param $layout
     * @return void
     */
    public function setLayout($layout):void
    {
        $this->layout = $layout;
    }
}