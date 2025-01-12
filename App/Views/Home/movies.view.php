<?php
/** @var Array $data
 * @var LinkGenerator $link
 * @var App\Core\IAuthenticator $auth */

use App\Config\Configuration;
use App\Core\LinkGenerator;
use App\Helpers\FileStorage;

?>

<main class="container-fluid mt-4">
    <section class="book-reviews-section">
        <h1 class="text-center text-purple">Movies Reviews</h1>
        <p class="text-center text-light">
            Welcome to the Movies Reviews section. Here, we share insightful reviews of our favorite movies. Explore a variety of genres and find your next great watch!
        </p>

        <?php require 'reviews.view.php' ?>
        <!-- Quote of the Week Section -->
        <div class="col-lg-3 col-12">
            <div class="quote-of-the-week bg-dark p-3 rounded shadow-sm">
                <h4 class="text-purple text-center">Quote of the Week</h4>
                <p class="text-light text-center">
                    "I'm gonna make him an offer he can't refuse." -The Godfather (1972)
                </p>
            </div>
        </div>


        <!-- My Favourites Section -->
        <section class="my-favourites mt-4">
            <h3 class="text-center text-purple">My Favourite Movies</h3>
            <p class="text-center text-light">
                Here are some of my all-time favourite movies that have left a lasting impact.
            </p>
            <!-- Display Favourites -->
            <?php if ($auth->isLogged()): ?>
                <div class="row mt-4 favourites-container">
                    <?php
                    if (sizeof($data['favourites']) == 0):
                        echo '<p class="text-center text-light no-favourites"> You have no favourites!</p>';
                    else:
                        foreach ($data['favourites'] as $favourite): ?>
                            <div class="col-md-3 col-6 mb-4 favourite-item" data-id="<?= $favourite->getId(); ?>">
                                <a href="<?= $link->url('post.detail', ['id' => $favourite->getId()]) ?>" class="d-block">
                                    <img src="<?= $favourite->getIsURL() ? $favourite->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $favourite->getObrazok(); ?>"
                                         alt="Favourite Book" class="img-fluid rounded shadow-sm">
                                </a>
                                <!-- Star Icon for Favourites -->
                                <i class="star-icon filled fas fa-star" data-id="<?= $favourite->getId(); ?>"></i>
                            </div>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
            <?php else: ?>
                <a href="<?= Configuration::LOGIN_URL ?>" class="text-light text-decoration-none">
                    <p class="text-center text-light"> Log in or register to add favourite movies!</p>
                </a>
            <?php endif; ?>
        </section>
    </section>
</main>
