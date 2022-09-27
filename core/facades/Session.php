<?php

namespace momik\simplemvc\core\facades;

use momik\simplemvc\core\Application;

class Session
{

    /**
     * @param $key
     * @param $message
     * @return void
     */
    public static function setFlash($key, $message): void
    {
        Application::$app->session->setFlash($key, $message);
    }


    /**
     * @param $key
     * @return void
     */
    public static function getFlash($key): void
    {
        Application::$app->session->getFlash($key);

    }

    /**
     * @param $key
     * @param $message
     * @return void
     */
    public static function set($key, $message): void
    {
        Application::$app->session->set($key, $message);

    }

    /**
     * @param $key
     * @return false|mixed
     */
    public static function get($key) {
        return Application::$app->session->get($key);

    }

    /**
     * @param $key
     * @return void
     */
    public static function remove($key): void
    {
        Application::$app->session->remove($key);

    }

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key):bool{
        return Application::$app->session->exists($key);
    }

}