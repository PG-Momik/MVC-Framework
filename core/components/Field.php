<?php

namespace momik\simplemvc\core\components;

class Field
{

    public string $type;
    public string $errorMsg   = '';
    public array  $attributes = [
        'id'          => '',
        'name'        => '',
        'label'       => '',
        'class'       => '',
        'placeholder' => '',
        'value'       => '',
        'min'         => false,
        'max'         => false,
        'length'      => false,
        'required'    => false,
    ];


    /**
     * @param string $type
     * @param array $attributes
     * @param string $errorMsg
     */
    public function __construct(string $type, array $attributes = [], string $errorMsg = '')
    {
        $this->type = $type;
        if ( is_array($attributes) ) {
            foreach ( $attributes as $key => $attribute ) {
                $this->attributes["$key"] = $attribute;
            }
        }
        $this->errorMsg = $errorMsg;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $opening  = "<div class='form-group'>";
        $id       = $this->attributes['id'];
        $label    = $this->attributes['label'];
        $min      = $this->attributes['min'];
        $max      = $this->attributes['max'];
        $length   = $this->attributes['length'];
        $required = $this->attributes['required'] ? "required" : '';

        $labelTag = "<label for='$id'>$label</label>";
        $errMsg   = "<div class='invalid-feedback'>$this->errorMsg</div>";
        $closing  = "</div>";
        $inputTag = sprintf(
            "<input type='%s' 
                           id='%s' 
                           name='%s'
                           placeholder='%s' 
                           class='form-control %s' 
                           value='%s' %s %s %s %s/>",
            $this->type,
            $this->attributes['id'],
            $this->attributes['name'],
            $this->attributes['placeholder'],
            $this->errorMsg ? 'is-invalid' : '',
            $this->attributes['value'],
            $min ? "min=$min" : '',
            $max ? "max=$max" : '',
            $length ? "length=$length" : '',
            $required ? "required=true" : ''
        );

        return $opening . $labelTag . $inputTag . $errMsg . $closing;
    }

}