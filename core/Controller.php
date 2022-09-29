<?php

namespace momik\simplemvc\core;

class Controller
{

    /**
     * @param string $view
     * @param array $params
     * @return string|array|bool
     */
    public string $layout = 'main';
    
    /**
     * @param $layout
     * @return void
     */
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

}