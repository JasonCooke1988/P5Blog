<?php

use App\Helper\Template;
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
            <?php if (isset($error)): ?>
                <div class="form-error alert-danger">
                    <p id="form-error" class="error-message"><?= $error ?></p>
                </div>
            <?php endif ?>
            <?php if (isset($success)): ?>
                <div class="form-success alert-success">
                    <p id="form-success" class="success-message"><?= $success ?></p>
                </div>
            <?php endif ?>
            <p>Cliquez sur un post pour accéder à la page permettant de le modifier et de valider les commentaires.</p>
            <?php
            foreach ($posts as $post):
                ?>
                <div class="post-preview">
                    <a href="<?= Template::getBasePath() ?>/modify-post/<?= $post->getId() ?>">
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
                <p><?= substr($post->getContent(),0,20); ?>...</p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<hr>
<?php require_once 'footer.php'; ?>
