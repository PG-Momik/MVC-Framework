<?php

namespace momik\simplemvc\core;

class Model
{

    /**
     * @param array $data
     * @return void
     */
    public function initializeProperties(array $data): void
    {
        foreach ( $data as $key => $value ) {
            if ( property_exists($this, $key) ) {
                $this->$key = $value;
            }
        }
    }

}