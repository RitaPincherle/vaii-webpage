<?php
/** @var Array $data
 * @var LinkGenerator $link
 * @var App\Core\IAuthenticator $auth */

use App\Core\LinkGenerator;
use App\Helpers\FileStorage;

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h1 class="post-title"><?= htmlspecialchars($data['post']->getNazov()) ?></h1>
                </div>
                <div class="card-body">
                    <img src="<?= $data['post']->getIsURL() ? $data['post']->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $data['post']->getObrazok(); ?>"
                         alt="<?= htmlspecialchars($data['post']->getNazov()) ?>" class="img-fluid rounded mb-4 post-image">
                    <p class="post-author text">By: <?= htmlspecialchars($data['post']->getAutor()) ?></p>
                    <p class="post-text"><?= nl2br(htmlspecialchars($data['post']->getText())) ?></p>
                </div>
                <div class="card-footer text-center">
                    <div class="post-rating">
                        <strong>Rating:</strong> <?= htmlspecialchars($data['post']->getRating()) ?>/10
                    </div>
                    <div class="post-actions mt-3">
                        <a href="javascript:history.back()"
                           class="back-icon ml-2"
                           style="font-size: 1.5rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <a href="<?= $link->url('post.edit', ['id' => $data['post']->getId()]) ?>"
                           class="edit-icon ml-2"
                           style="font-size: 1.5rem; margin-left: 10px;">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="<?= $link->url('post.delete', ['id' => $data['post']->getId()]) ?>"
                           class="delete-icon ml-2"
                           style="font-size: 1.5rem; margin-left: 10px;">
                            <i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

