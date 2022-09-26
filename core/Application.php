<?php

namespace momik\simplemvc\core;

use momik\simplemvc\models\User;

class Application
{

    public static string      $ROOT_DIR;
    public Request            $request;
    public Response           $response;
    public Router             $router;
    public static Application $app;
    public Controller         $controller;
    public Database           $database;
    public Session            $session;
    public User               $user;
    public View               $view;

    /**
     * @param string $rootPath
     * @param array $config
     */
    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app      = $this;
        $this->request  = new Request();
        $this->response = new Response();
        $this->router   = new Router($this->request, $this->response);
        $this->database = new Database($config['db']);
        $this->session  = new Session();
        $this->user     = new User();
        $this->view     = new View();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }


    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }

}