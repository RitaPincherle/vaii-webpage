<?php
/** @var LinkGenerator $link */
/** @var Array $data */
/** @var array|null $errors */

use App\Core\LinkGenerator;
use App\Models\Comment;
use App\Models\Post;

?>

<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach (@$data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h1 class="post-title"><?= htmlspecialchars(@$data['post']->getNazov()) ?></h1>
                </div>
                <div class="card-body">
                    <img src="<?= @$data['post']->getIsURL() ?@$data['post']->getObrazok() : \App\Helpers\FileStorage::UPLOAD_DIR . '/' . @$data['post']->getObrazok(); ?>"
                         alt="<?= htmlspecialchars(@$data['post']->getNazov()) ?>" class="img-fluid rounded mb-4 post-image">
                    <p class="post-author text">By: <?= htmlspecialchars(@$data['post']->getAutor()) ?></p>
                    <p class="post-text"><?= nl2br(htmlspecialchars(@$data['post']->getText())) ?></p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3><?=!is_null(@$data['comment']) ? 'Edit Your Comment' : 'Add a Comment' ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= $link->url("comment.upload") ?>" method="POST">
                        <input type="hidden" name="id" value="<?= @$data['comment']?->getId() ?? '' ?>">
                        <input type="hidden" name="id_postu" value="<?= @$data['post']->getId() ?>">

                        <div class="mb-3">
                            <label for="commentText" class="form-label">Your Comment</label>
                            <textarea class="form-control" id="commentText" name="text" rows="5" placeholder="Write your comment here..." required><?= htmlspecialchars(@$data['comment']?->getText() ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn custom-btn">Save</button>
                        <a href="<?= $link->url("post.detail", ['id' => @$data['post']->getId()]) ?>" class="btn custom-btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

