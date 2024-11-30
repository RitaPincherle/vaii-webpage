<?php
/** @var Array $data
 * @var \App\Core\LinkGenerator $link
 * @var App\Core\IAuthenticator $auth */

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
                    $i = 1;
                    foreach ($data['posts'] as $post):
                        ?>
                        <div class="col-md-4 col-6 mb-3 image-container">


                            <img src="<?= $post->getIsURL() ? $post->getObrazok() : \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                 alt="Book <?= $i; ?>" class="img-fluid rounded shadow-sm">

                            <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $post->getAutor())){ ?>
                                <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>"
                                   class="edit-icon"
                                   style=" top: 5px; right: 20px; font-size: 1.5rem; margin-right: 10px">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>"
                                   class="delete-icon"
                                   style="top: 5px; right: 20px; font-size: 1.5rem">
                                    <i class="fas fa-trash-alt"></i>
                                </a>

                            <?php } ?>
                        </div>
                        <?php
                        $i++;
                    endforeach;
                    ?>
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
            <h3 class="text-center text-purple">My Favourites</h3>
            <p class="text-center text-light">
                Here are some of my all-time favourite books that have left a lasting impact.
            </p>
            <!-- Display Favourites -->
            <div class="row mt-4">
                <?php
                // Displaying a set of 4 "favourite" books
                for ($i = 1; $i <= 4; $i++) {
                    echo '<div class="col-md-3 col-6 mb-4">';
                    echo '<img src="https://picsum.photos/300/200?random=' . ($i + 10) . '" alt="Favourite Book ' . $i . '" class="img-fluid rounded shadow-sm">';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </section>
</main>
