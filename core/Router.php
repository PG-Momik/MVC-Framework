<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes = [];

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $path
     * @param $callback
     * @return void
     */
    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return array|false|mixed|string|string[]
     */
    public function resolve(): mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            Application::$app->response->setStatusCode(404);

            return "Page not found";
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            $instance = new $callback[0];
            $callback[0] = $instance;
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * @param string $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView(string $view, array $params = []): array|bool|string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent(): bool|string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/main.php";

        return ob_get_clean();
    }

    /**
     * @param string $view
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