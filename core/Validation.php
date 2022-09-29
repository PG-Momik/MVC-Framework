<?php

namespace momik\simplemvc\core;

enum Validation
{

    public const CASES = array(
        'firstname'       => 'alpha',
        'lastname'        => 'alpha',
        'email'           => 'email',
        'phone'           => 'phone',
        'city'            => 'alphaNumSpace',
        'state'           => 'alphaNumSpace',
        'password'        => 'password',
        'confirmPassword' => 'password',
        'age'             => 'numeric'
    );

    public const CHECK = [
        'alpha'         => "/^[A-Za-z]+$/",
        //works
        'alphaNum'      => "/^[A-Za-z0-9]+/",
        //works
        'alphaSpace'    => "/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/",
        //works
        'alphaNumSpace' => "/^[a-z\d\s]+$/i",
        //works
        'numeric'       => "/^[0-9]*$/",
        'email'         => "/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/",
        //works
        'phone'         => "/^[0-9]{10}$/",
        //works
        'password'      => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
        //incomplete, doesn't allow special chars
        'url'           => "/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/"
        //works
    ];

    public const ERROR = [
        'alpha'         => 'No numbers or symbols allowed.',
        'alphaNum'      => 'No symbols allowed.',
        'alphaNumSpace' => 'No special symbols allowed.',
        'num'           => 'Only numbers allowed.',
        'email'         => 'Enter valid email',
        'phone'         => 'Enter valid phone.',
        'alphaSpace'    => "Only alphabets and space allowed.",
        'password'      => 'Enter valid password',
        'url'           => "Invalid URL"
    ];

    /**
     * @param string $type
     * @param string $value
     * @return string|null
     */
    public static function start(string $type, string $value): null | string
    {
        if ( !preg_match(self::CHECK[self::CASES[$type]], $value) ) {
            return self::ERROR[self::CASES[$type]];
        }

        return null;
    }

    /**
     * @param $formFields
     * @return array
     */
    public static function validate($formFields): array
    {
        $returnVal = [];
        foreach ( $formFields as $key => $formField ) {
            $error = self::start($key, $formField);
            if ( $error !== null ) {
                $returnVal[$key] = $error;
            }
        }

        return $returnVal;
    }

}
