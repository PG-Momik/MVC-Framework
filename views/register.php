<?php


use momik\simplemvc\core\components\Form;

/** @var  $this momik\simplemvc\core\View */
$this->title = "Home";
$errors      = $this->params['errors'] ?? null;
$success     = $this->params['success'] ?? null;
?>

    <h1>Register Now.</h1>
<?php
if ( $success ) {
    echo "<p class='alert alert-success'>$success</p>";
}
?>
<?php
Form::open('', "post");
echo Form::field("text", ['name' => 'firstname', 'placeholder'=>'Firstname here'], $errors['firstname'] ?? '');
echo Form::field("text", ['name' => 'lastname', 'placeholder'=>'Lastname here'], $errors['lastname'] ?? '');
echo Form::field("text", ['name' => 'phone', 'placeholder'=>'Phone here'], $errors['phone'] ?? '');
echo Form::field("email", ['name' => 'email', 'placeholder'=>'Email here'], $errors['email'] ?? '');
echo Form::field("text", ['name' => 'city', 'placeholder'=>'City here'], $errors['city'] ?? '');
echo Form::field("text", ['name' => 'state', 'placeholder'=>'State here'], $errors['state'] ?? '');
echo Form::field("password", ['name' => 'password', 'placeholder'=>'Password here'], $errors['password'] ?? '');
echo "<button type='submit' class='btn btn-md btn-primary my-2 col-12'>Register</buton>";
Form::close();
?>