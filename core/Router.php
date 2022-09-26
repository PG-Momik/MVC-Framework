<?php

namespace momik\simplemvc\core;

class Router
{

    public Request  $request;
    public Response $response;

    protected array $routes = [];

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
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
        $path     = $this->request->getPath();
        $method   = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ( !$callback ) {
            Application::$app->response->setStatusCode(404);

            return "Page not found";
        }
        if ( is_string($callback) ) {
            return Application::$app->view->renderView($callback);
        }
        if ( is_array($callback) ) {
            Application::$app->controller = new $callback[0];
            $callback[0]                  = Application::$app->controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }


}