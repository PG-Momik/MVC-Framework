<?php

/** @var  $this momik\simplemvc\core\View */
$this->title = "Contact us"

?>

<h1>Contact</h1>
<form action="" method="post">
    <?php

    use momik\simplemvc\core\form\Form;

    Form::open();
    echo Form::field('text', ['id' => 'uname', 'name' => 'uname', 'label' => 'Username']);
    echo Form::field('email');
    echo Form::field('number');
    echo Form::field('password');
    Form::close();

    ?>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>