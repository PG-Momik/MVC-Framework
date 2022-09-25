<?php

namespace app\core;

class Model
{

    /**
     * @param array $data
     * @return void
     */
    public function fillProperties(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

}