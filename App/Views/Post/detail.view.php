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
                    <p class="post-author">By: <?= htmlspecialchars($data['post']->getAutor()) ?></p>
                    <p class="post-text"><?= nl2br(htmlspecialchars($data['post']->getText())) ?></p>
                </div>
                <div class="card-footer">
                    <!-- Comments Section -->
                    <div class="comments-section mt-3">
                        <h3>Comments</h3>
                        <?php if (!empty($data['comments'])): ?>
                            <?php foreach ($data['comments'] as $comment): ?>
                                <div class="comment mb-3 p-3 border rounded">
                                    <p class="comment-author font-weight-bold">
                                        By: <?= htmlspecialchars($comment->getAutor()) ?>
                                    </p>
                                    <p class="comment-text"><?= nl2br(htmlspecialchars($comment->getText())) ?></p>

                                    <?php if ($auth->isLogged() && $auth->getLoggedUserName() == $comment->getAutor() || $auth->isAdmin()): ?>
                                        <div class="comment-actions mt-2">
                                            <a href="<?= $link->url('comment.edit', ['id' => $comment->getId()]) ?>"
                                               class="edit-icon ml-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="<?= $link->url('comment.delete', ['id' => $comment->getId()]) ?>"
                                               class="delete-icon ml-2">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-white">No comments yet. Be the first to comment!</p>
                        <?php endif; ?>

                        <!-- Add Comment Section (optional, if user is logged in) -->
                        <?php if ($auth->isLogged()): ?>
                            <form method="post" action="<?= $link->url('comment.upload', ['id_postu' => $data['post']->getId()]) ?>" class="mt-3">
                                <div class="form-group">
                                    <label for="commentText" class="form-label text-purple">Add a comment</label>
                                    <textarea name="text" id="commentText" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn custom-btn">Submit</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Post Actions -->
                    <div class="post-actions text-center mt-4">
                        <a href="javascript:history.back()"
                           class="back-icon ml-2"
                           style="font-size: 1.5rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $data['post']->getAutor()) || $auth->isAdmin()) { ?>
                            <a href="<?= $link->url('post.edit', ['id' => $data['post']->getId()]) ?>"
                               class="edit-icon ml-2">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="<?= $link->url('post.delete', ['id' => $data['post']->getId()]) ?>"
                               class="delete-icon ml-2">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
