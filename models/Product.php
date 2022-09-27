<?php

namespace momik\simplemvc\models;

use momik\simplemvc\core\Model;

class Product extends Model
{

    /**
     * @return string
     */
    public function tableName(): string
    {
        return "products";
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
            "name",
            "created_at"
        ];
    }

}