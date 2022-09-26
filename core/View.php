<?php

namespace momik\simplemvc;

class View
{
    public string $title = '';

    /**
     * @param string $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView(string $view, array $params = []): array|bool|string
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent(): bool|string
    {
        $layout = Application::$app->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";

        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param $params
     * @return bool|string
     */
    protected function renderOnlyView(string $view, $params): bool|string
    {
        foreach ($params as $index => $param) {
            $$index = $param;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";

        return ob_get_clean();
    }
}