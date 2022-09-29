<?php use momik\simplemvc\core\facades\Session; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="./assets/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <?php
                if ( Session::exists('uid') and Session::exists('firstname')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="/logout">Logout <?= Session::get('firstname') ?></a>
                    </li>

                <?php
                else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php
                endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    {{content}}
</div>
<script src="./assets/bootstrap.js"></script>
</body>
</html>