<?php

use App\Model\Post;

/**
 * @var Post[] $posts
 */
include 'head.php';
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
                            <?= $post->getContent(); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posté par
                        <a href="#"><?= $post->getFullName() ?></a>
                        le <?= $post->getCreatedAt() ?></p>
                </div>
                <p><?= $post->getHeader() ?></p>
                <hr>

            <?php endforeach; ?>
        </div>
    </div>
</div>

<hr>
<?php require_once('footer.php'); ?>
