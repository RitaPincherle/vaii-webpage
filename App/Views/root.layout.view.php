<?php

/** @var string $contentHTML */
/** @var IAuthenticator $auth */
/** @var LinkGenerator $link */

use App\Config\Configuration;
use App\Core\IAuthenticator;
use App\Core\LinkGenerator;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/form.css">
<!--    <link rel="stylesheet" href="public/css/styl.css">-->
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/auth.css">
    <link rel="stylesheet" href="public/css/detail.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid bg-black">
        <a class="navbar-brand" href="<?= $link->url("home.index") ?>">
            <img src="public/images/logo.webp" alt="logo" title="Review Hub" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("home.index") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("home.books") ?>">Books Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("home.movies") ?>">Movies Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("home.series") ?>">Series Reviews</a>
                </li>
            </ul>

            <?php if ($auth->isLogged()) { ?>
                <ul class="navbar-nav ms-auto"> <!-- Add ms-auto here -->
                    <li class="nav-item">
                        <span class="navbar-text">Logged user: <b><?= $auth->getLoggedUserName() ?></b></span>
                    </li>

                    <?php if ($auth->isAdmin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $link->url("admin.index") ?>">Admin page</a>
                        </li>
                    <?php }?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("post.add") ?>">Add review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("post.myReviews") ?>">My reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("auth.logout") ?>">Logout</a>
                    </li>

                </ul>
            <?php } else { ?>
                <ul class="navbar-nav ms-auto"> <!-- Add ms-auto here -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Configuration::LOGIN_URL ?>">Login</a>
                    </li>
                </ul>
            <?php } ?>
        </div>

    </div>
</nav>

<!-- Main Content -->
<main class="container-fluid mt-3">
    <div class="web-content text-light">
        <?= $contentHTML ?>
    </div>
</main>

<!-- Footer -->
<footer class="bg-black text-light text-center py-3">
    <div class="container">
        <p>&copy; 2024 Review Hub. All Rights Reserved.</p>
        <p>
            <a href="#" class="text-purple text-decoration-none me-2">Privacy Policy</a>
            <a href="#" class="text-purple text-decoration-none">Terms of Service</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/script.js"></script>
</body>
</html>


