<?php

namespace momik\simplemvc\models;

use momik\simplemvc\core\Model;

class User extends Model
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
        return "users";
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
     * fields of table.
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