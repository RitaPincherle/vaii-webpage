<?php

use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Post;
/** @var LinkGenerator $link */
/** @var Post[] $data */
/** @var App\Core\IAuthenticator $auth */

?>
<!-- Main Content -->
<main class="container my-4">
    <div class="row">
        <div class="col-12 mb-4">
            <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php if ($data[0]->getIsURL() == 1) {?>
                        <img src="<?php echo $data[0]->getObrazok()?>" class="d-block w-100 h-60" alt="">
                        <?php } else { ?>
                            <img src="<?php  echo FileStorage::UPLOAD_DIR . '/' .$data[0]->getObrazok() ?>" class="d-block w-100 h-60" alt="">
                        <?php }?>
                    </div>

                    <?php
                        for ($i = 1; $i < sizeof($data); $i++) {?>
                            <div class="carousel-item ">
                                <?php if ($data[$i]->getIsURL() == 1) {?>
                                    <img src="<?php echo $data[$i]->getObrazok()?>" class="d-block w-100 h-60" alt="">
                                <?php } else { ?>
                                    <img src="<?php  echo FileStorage::UPLOAD_DIR . '/' .$data[$i]->getObrazok() ?>" class="d-block w-100 h-60" alt="">
                                <?php }?>
                            </div>
                        <?php }?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <?php for ($i = 0; $i < sizeof($data); $i++) {?>
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="card shadow-sm">
                            <?php if ($data[$i]->getIsURL() == 1) {?>
                                <img src="<?php echo $data[$i]->getObrazok() ?>" class="card-img-top" alt="">
                            <?php } else { ?>
                                <img src="<?php  echo FileStorage::UPLOAD_DIR . '/' .$data[$i]->getObrazok() ?>" class="card-img-top" alt="">
                                <?php }?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data[$i]->getNazov() ?></h5>
                                <p class="card-text">
                                    <?php echo mb_substr($data[$i]->getText(), 0, 60) . (mb_strlen($data[$i]->getText()) > 60 ? '...' : '') ?>
                                </p>
                                <p class="text">Rating: <?php echo $data[$i]->getRating() ?></p>

                                <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $data[$i]->getAutor()) || $auth->isAdmin()): ?>
                                    <div class="icon-group" style="display: inline-flex; align-items: center;">
                                        <a href="<?= $link->url('post.edit', ['id' => $data[$i]->getId()]) ?>"
                                           class="edit-icon"
                                           style="font-size: 1.5rem; margin-right: 10px;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= $link->url('post.delete', ['id' => $data[$i]->getId()]) ?>"
                                           class="delete-icon"
                                           style="font-size: 1.5rem;">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($i > 10) { break; } } ?>
            </div>
        </div>

        <div class="col-lg-3 col-12 mt-4 mt-lg-0">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Trending Books</a>
                <a href="#" class="list-group-item list-group-item-action">Top Rated Movies</a>
                <a href="#" class="list-group-item list-group-item-action">Trending Series</a>
                <a href="#" class="list-group-item list-group-item-action">New posts</a>
            </div>
        </div>
    </div>
</main>

