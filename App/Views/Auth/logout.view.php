<?php

$layout = 'auth';
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5">
            You logged out. <br>
            Do you wanna <a href="<?= \App\Config\Configuration::LOGIN_URL ?>">log in again</a> or go<a
                    href="<?= $link->url("home.index") ?>">back to </a> the main page?
        </div>
    </div>
</div>