<?php

/** @var  $this momik\simplemvc\core\View */

use momik\simplemvc\core\components\Form;

$this->title = "Login";

?>

<h1>Login</h1>
<?php
Form::open('', "post");
echo Form::field("email", ['name' => 'email', 'placeholder'=>'Email here'], $errors['email'] ?? '');
echo Form::field("password", ['name' => 'password', 'placeholder'=>'Password here'], $errors['password'] ?? '');
echo "<button type='submit' class='btn btn-md btn-primary my-2 col-12'>Login</buton>";
Form::close();

?>