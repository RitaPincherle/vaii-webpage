<?php
/** @var Array $data
 * @var LinkGenerator $link
 * @var App\Core\IAuthenticator $auth */


use App\Core\LinkGenerator;
use App\Helpers\FileStorage;

?>
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
