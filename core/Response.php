<?php

namespace momik\simplemvc\core;

class Response
{

    /**
     * @param int $code
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * @param $url
     * @return void
     */
    public function redirect($url): void
    {
        header("Location: $url");
    }

}