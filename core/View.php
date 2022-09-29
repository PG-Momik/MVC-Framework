<?php

namespace momik\simplemvc\core;

class View
{

    /**
     * @param string $view
     * @param array $params
     */
    public function __construct(protected string $view, protected array $params = []) {}

    /**
     * @param string $view
     * @param array $params
     * @return static
     */
    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    /**
     * @return string|string[]
     */
    public function renderView(): string
    {
        $viewContent   = $this->renderOnlyView();
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @param string $view
     * @param $params
     * @return bool|string
     */
    protected function renderOnlyView(): bool | string
    {
        foreach ( $this->params as $index => $param ) {
            $$index = $param;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$this->view.php";

        return ob_get_clean();
    }

    /**
     * @return false|string
     */
    protected function layoutContent(): bool | string
    {
        $layout = Application::$app->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";

        return ob_get_clean();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->renderView();
    }

}