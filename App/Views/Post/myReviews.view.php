<?php
/** @var LinkGenerator $link */
/** @var array $data */
/** @var Post[] $data['movies'] */
/** @var Post[] $data['series'] */
/** @var Post[] $data['books'] */

use App\Core\LinkGenerator;
use App\Helpers\FileStorage;
use App\Models\Post;

?>

<div class="container mt-5">
    <h1 class="text-center">My Posts</h1>
    <hr class="mb-4">

    <!-- Movies Section -->
    <div class="category-section">
        <h2 class="text-purple">Movies</h2>
        <?php if (!empty($data['movies'])): ?>
            <div class="row">
                <?php foreach ($data['movies'] as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?= $post->getIsURL() ? $post->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                 alt="<?= htmlspecialchars($post->getNazov()) ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post->getNazov()) ?></h5>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="btn custom-btn">View Details</a>
                                    <div class="post-actions">
                                        <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" title="Edit" class="edit-icon ml-2">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>" title="Delete" class="delete-icon ml-2" onclick="return confirm('Are you sure you want to delete this post?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No posts found in this category.</p>
        <?php endif; ?>
    </div>

    <!-- Series Section -->
    <div class="category-section mt-5">
        <h2 class="text-purple">Series</h2>
        <?php if (!empty($data['series'])): ?>
            <div class="row">
                <?php foreach ($data['series'] as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?= $post->getIsURL() ? $post->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                 alt="<?= htmlspecialchars($post->getNazov()) ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post->getNazov()) ?></h5>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="btn custom-btn">View Details</a>
                                    <div class="post-actions">
                                        <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" title="Edit" class="edit-icon ml-2">
                                        <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>" title="Delete" class="delete-icon ml-2" onclick="return confirm('Are you sure you want to delete this post?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No posts found in this category.</p>
        <?php endif; ?>
    </div>

    <!-- Books Section -->
    <div class="category-section mt-5">
        <h2 class="text-purple">Books</h2>
        <?php if (!empty($data['books'])): ?>
            <div class="row">
                <?php foreach ($data['books'] as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?= $post->getIsURL() ? $post->getObrazok() : FileStorage::UPLOAD_DIR . '/' . $post->getObrazok(); ?>"
                                 alt="<?= htmlspecialchars($post->getNazov()) ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post->getNazov()) ?></h5>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="btn custom-btn">View Details</a>
                                    <div class="post-actions">
                                        <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" title="Edit" class="edit-icon ml-2">
                                        <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>" title="Delete" class="delete-icon ml-2" onclick="return confirm('Are you sure you want to delete this post?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No posts found in this category.</p>
        <?php endif; ?>
    </div>
</div>

