<?php

namespace momik\simplemvc\core\components;

class Form
{

    /**
     * @param string $action
     * @param string $method
     * @return string
     */
    public static function open(string $action = '', string $method = 'get'): Form
    {
        echo sprintf("<form action='%s' method='%s'>", $action, $method);

        return new Form();
    }


    /**
     * @return void
     */
    public static function close(): void
    {
        echo "</form>";
    }

    /**
     * @param string $type
     * @param array|string $attributes
     * @param string $errorMsg
     * @return Field
     */
    public static function field(string $type, array $attributes = [], string $errorMsg = ''): Field
    {
        return new Field($type, $attributes, $errorMsg);
    }

}