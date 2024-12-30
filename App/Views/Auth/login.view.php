<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>


<div class="card-body">
    <h3 style="text-align: center;">Welcome!</h3>
    <div class="error-text">
        <?= @$data['message'] ?>
    </div>
    <form class="form-signin" method="post" action="<?= $link->url("login") ?>">
        <div class="form-label-group mb-3">
            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                   required autofocus>
        </div>

        <div class="form-label-group mb-3">
            <input name="password" type="password" id="password" class="form-control"
                   placeholder="Password" required>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" name="submit">Log In
            </button>
            <p id="switch-form" onclick="switchForm()">Don't have an account? Register here</p>
        </div>
    </form>
    <form class="form-signup" method="post" action="<?= $link->url("register") ?>" style="display: none;">
        <!-- Add registration form fields here -->
        <div class="form-label-group mb-3">
            <input name="login" type="text" id="login" class="form-control" placeholder="login" required>
        </div>
        <div class="form-label-group mb-3">
            <input name="password" type="password" id="password" class="form-control" placeholder="Password"
                   required>
        </div>
        <div class="form-label-group mb-3">
            <input name="repassword" type="password" id="repassword" class="form-control"
                   placeholder="Retype Password" required>
        </div>

        <div class="text-center">
            <button class="btn btn-success" type="submit" name="submit">Register</button>
            <p id="switch-form" onclick="switchForm()">Already have an account? Log in here</p>
        </div>
    </form>
</div>