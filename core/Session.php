<?php

namespace momik\simplemvc\core;

class Session
{

    protected const FLASH_KEY = "flash_msg";

    public function __construct()
    {
        if ( session_status() == PHP_SESSION_NONE ) {
            session_start();
        }
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ( $flashMessages as &$flashMessage ) {
            $flashMessage["remove"] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * @param string $key
     * @param string $message
     * @return void
     */
    public function setFlash(string $key, string $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove'  => false,
            'message' => $message
        ];
    }

    /**
     * @param $key
     * @return false|string|array
     */
    public function getFlash($key): false | string | array
    {
        return $_SESSION[self::FLASH_KEY][$key]['message'] ?? false;
    }

    /**
     * @param $key
     * @return false|mixed
     */
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    /**
     * @param $key
     * @param $message
     * @return void
     */
    public function set($key, $message): void
    {
        $_SESSION[$key] = $message;
    }

    /**
     * @param $key
     * @return void
     */
    public function remove($key): void
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ( $flashMessages as $key => &$flashMessage ) {
            if ( $flashMessage['remove'] ) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

}