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
            <h1 class="text-center text-purple">Series Reviews</h1>
            <p class="text-center text-light">
                Welcome to the Series reviews section. Here, we share insightful reviews of our favorite series. Explore a variety of genres and find your next great watch!
            </p>

            <div class="row mt-4">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($data['posts'] as $post):
                            ?>
                            <div class="col-md-4 col-6 mb-3 image-container">
                                <!-- Link wrapping the image -->
                                <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="d-block">
                                    <img src="<?= $post->getIsURL() ? $post->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                         alt="Book <?= $i; ?>" class="img-fluid rounded shadow-sm">
                                </a>
                                <!-- Styled Title -->
                                <div class="d-flex align-items-center">
                                    <p class="text-left text-light mb-0" style="font-size: 1rem; font-weight: bold;">
                                        <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="text-light text-decoration-none">
                                            <?= $post->getNazov(); ?>
                                        </a>
                                    </p>
                                    <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $post->getAutor()) || $auth->isAdmin()){ ?>
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
                                    <?php } ?>
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
                            "Frankly, my dear, I don't give a damn." -Gone with the Wind (1939)
                        </p>
                    </div>
                </div>
            </div>

            <!-- My Favourites Section -->
            <section class="my-favourites mt-4">
                <h3 class="text-center text-purple">My Favourite Series</h3>
                <p class="text-center text-light">
                    Here are some of my all-time favourite series that have left a lasting impact.
                </p>
                <!-- Display Favourites -->
                <?php if ($auth->isLogged()) {?>
                    <div class="row mt-4">
                        <?php
                        $i = 1;
                        if(sizeof($data['favourites']) == 0):
                            {
                                echo '<p class="text-center text-light"> You have no favourite series!</p>';
                            } else: {
                            foreach ($data['favourites'] as $favourite):
                                {
                                    echo '<div class="col-md-3 col-6 mb-4">';
                                    echo '<a href="' . $link->url('post.detail', ['id' => $favourite->getId()]) . '" class="d-block">';
                                    echo '<img src="' . ($favourite->getIsURL() ? $favourite->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $favourite->getObrazok()) . '" alt="Favourite Book ' . $i . '" class="img-fluid rounded shadow-sm">';
                                    echo '</a>';
                                    echo '</div>';
                                }
                                $i++;
                            endforeach;
                        }endif;

                        ?>
                    </div>
                <?php } else {
                    echo '<a href="'.Configuration::LOGIN_URL.'" class="text-light text-decoration-none">';
                    echo '<p class="text-center text-light"> Log in or register to add favourite books!</p>';
                    echo '</a>';
                }?>


            </section>
        </section>
    </main>
<?php
