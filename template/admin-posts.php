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
                            <?= $post->getContent(); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posté par
                        <p><?= $post->getFullName() ?></p>
                        le <?= $post->getCreatedAt() ?></p>
                </div>
                <p><?= $post->getHeader() ?></p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<hr>
<?php require_once 'footer.php'; ?>
