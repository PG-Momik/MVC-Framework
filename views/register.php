<h1>Register</h1>
<?php
$alert = \app\core\Application::$app->session->getFlash('success');
if ($alert) {
    ?>
    <p class="alert alert-success">
        <?= $alert; ?>
    </p>
    <?php
} ?>
<form action="" method="post">
    <div class="row">
        <div class="col-6 mb-3">
            <label class="form-label">Firstname</label>
            <input type="text" name="firstname" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="col-6 mb-3">
            <label class="form-label">Lastname</label>
            <input type="text" name="lastname" class="form-control" aria-describedby="emailHelp">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="col-6 mb-3">
            <label class="form-label">State</label>
            <input type="text" name="state" class="form-control" aria-describedby="emailHelp">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="con-password" class="form-control">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>