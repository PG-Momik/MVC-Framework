<?php

/** @var  $this momik\simplemvc\core\View */
$this->title = "Login"

?>

<h1>Login</h1>
<form action="" method="post">
    <?php

    use momik\simplemvc\core\form\Form;

    Form::open(method:"post");
    echo Form::field('email', ['id' => 'email', 'name' => 'email', 'label' => 'Email']);
    echo Form::field('password', ['id'=>'password', 'name'=>'password', 'label'=>'Password']);
    echo '<br><button type="submit" class="btn btn-primary">Submit</button>';

    Form::close();
    ?>
</form>
