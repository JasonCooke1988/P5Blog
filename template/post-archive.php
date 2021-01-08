<?php

use App\Model\Post;

/**
 * @var Post[] $posts
 */
require_once 'head.php';
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            foreach ($posts as $post):
                ?>

                <div class="post-preview">
                    <a href="post/<?= $post->getId() ?>">
                        <h2 class="post-title">
                            <?= $post->getTitle(); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?= $post->getHeader() ?>
                        </h3>
                    </a>
                    <?php if ($post->getUpdatedAt() === null): ?>
                        <p class="post-meta">Posté par
                            <?= $post->getFullName() ?>
                            le <?= $post->getCreatedAt() ?></p>
                    <?php else: ?>
                        <p class="post-meta">Posté par
                            <?= $post->getFullName() ?> le <?= $post->getCreatedAt() ?>
                            dernière modification le <?= $post->getUpdatedAt() ?></p>
                    <?php endif; ?>
                </div>
                <p><?= substr($post->getContent(), 0, 20); ?>...</p>
                <hr>

            <?php endforeach; ?>
        </div>
    </div>
</div>

<hr>
<?php require_once('footer.php'); ?>
