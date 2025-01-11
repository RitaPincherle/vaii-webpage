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
        <h1 class="text-center text-purple">Book Reviews</h1>
        <p class="text-center text-light">
            Welcome to the Book Reviews section. Here, we share insightful reviews of our favorite books. Explore a variety of genres and find your next great read!
        </p>

        <div class="row mt-4">
            <!-- Book Images -->
            <div class="col-lg-9 col-12">
                <div class="row">
                    <?php
                    foreach ($data['posts'] as $post):
                        $isFavourite = in_array($post, $data['favourites']);
                        ?>
                        <div class="col-md-4 col-6 mb-3 image-container">
                            <!-- Link wrapping the image -->
                            <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="d-block">
                                <img src="<?= $post->getIsURL() ? $post->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                     alt="Book" class="img-fluid rounded shadow-sm">
                            </a>
                            <!-- Styled Title -->
                            <div class="d-flex align-items-center">
                                <p class="text-left text-light mb-0" style="font-size: 1rem; font-weight: bold;">
                                    <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="text-light text-decoration-none">
                                        <?= $post->getNazov(); ?>
                                    </a>
                                </p>

                                <!-- Star Icon for Favourites -->
                                <?php if ($auth->isLogged()): ?>
                                    <i class="star-icon <?= $isFavourite ? 'filled fas fa-star ' : 'far fa-star'; ?>"
                                       data-id="<?= $post->getId(); ?>"></i>
                                <?php endif; ?>

                                <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $post->getAutor()) || $auth->isAdmin()): ?>
                                    <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>"
                                       class="edit-icon ml-2"
                                       style="font-size: 1.2rem; margin-left: 10px;">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>"
                                       class="delete-icon ml-2"
                                       style="font-size: 1.2rem; margin-left: 10px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Quote of the Week Section -->
            <div class="col-lg-3 col-12">
                <div class="quote-of-the-week bg-dark p-3 rounded shadow-sm">
                    <h4 class="text-purple text-center">Quote of the Week</h4>
                    <p class="text-light text-center">
                        "A book is a dream that you hold in your hand." - Neil Gaiman
                    </p>
                </div>
            </div>
        </div>

        <!-- My Favourites Section -->
        <section class="my-favourites mt-4">
            <h3 class="text-center text-purple">My Favourite Books</h3>
            <p class="text-center text-light">
                Here are some of my all-time favourite books that have left a lasting impact.
            </p>
            <!-- Display Favourites -->
            <?php if ($auth->isLogged()): ?>
                <div class="row mt-4 favourites-container">
                    <?php
                    if (sizeof($data['favourites']) == 0):
                        echo '<p class="text-center text-light no-favourites"> You have no favourite books!</p>';
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
                    <p class="text-center text-light"> Log in or register to add favourite books!</p>
                </a>
            <?php endif; ?>
        </section>
    </section>
</main>
