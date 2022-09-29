<?php

/** @var  $this momik\simplemvc\core\View */
$this->title = "Home";
?>
<h1>Imagine a profile page here.</h1>
<h2>Welcome: <?= $firstname ?? '' ?></h2>
<p>
<pre>
    <?php
    echo "<h4>Session :</h4>";
    print_r($_SESSION);
    echo "<br>";
    echo "<h4>Details: </h4>";
    print_r($this->params); ?>
</pre>
</p>