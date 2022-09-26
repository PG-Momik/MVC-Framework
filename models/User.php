<?php

namespace momik\simplemvc\models;

use momik\simplemvc\core\DbModel;

class User extends DbModel
{

    public string $id;
    public string $firstname;
    public string $lastname;
    public string $phone;
    public string $email;
    public string $city;
    public string $state;
    public string $password;

    /**
     * @return string
     */
    public function tableName(): string
    {
        return "customers";
    }

    /**
     * @return string
     */
    public function primaryKey(): string
    {
        return "id";
    }

    /**
     * @return string[]
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

    /**
     * @return bool
     */
    public function register(): bool
    {
        return $this->save();
    }

}