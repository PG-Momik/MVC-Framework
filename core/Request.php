<?php

namespace momik\simplemvc\core;

class Request
{

    public function getPath()
    {
        $path     = $_SERVER['REQUEST_URI'] ?? "/";
        $position = strpos($path, "?");
        if ( !$position ) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function method(): string
    {
        return mb_strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        $sanitizedBody = [];
        switch ( $this->method() ) {
            case "get":
                foreach ( $_GET as $key => $value ) {
                    $sanitizedBody[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
            case "post":
                foreach ( $_POST as $key => $value ) {
//                    $sanitizedBody[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    $sanitizedBody[$key] = $value;
                }
                break;
        }

        return $sanitizedBody;
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->method() == 'get';
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() == 'post';
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value): void
    {
        $_POST[$key] = $value;
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key): string
    {
        return $_POST[$key];
    }

}