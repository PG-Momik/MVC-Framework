<?php

namespace momik\simplemvc\models;


use momik\simplemvc\core\DbModel;

class LoginForm extends DbModel
{

    /**
     * @inheritDoc
     */
    public function tableName(): string
    {
        return "customers";
    }

    /**
     * @inheritDoc
     */
    public function primaryKey(): string
    {
        return "id";
    }

    /**
     * @inheritDoc
     */
    public function fields(): array
    {
        return [
            "firstname",
            "lastname",
            "phone",
            "email",
            "city",
            "state",
            "password"
        ];
    }


}