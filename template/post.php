<?php
require_once 'head.php';

use App\Helper\Template; ?>

<!-- Main Content -->
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="section-heading"><?= $post->getTitle() ?></h2>
                <h3><?= $post->getHeader() ?> <br>
                    <small>Crée par <?= $post->getFullName() ?> le <?= $post->getCreatedAt() ?>
                        <?= $post->getUpdatedAt() !== null ? 'et modifié le ' . $post->getUpdatedAt() : "" ?></small>
                </h3>

                <p class="mb-5"> <?= $post->getContent() ?></p>
                <?php if (!empty($post->getComments())): ?>
                    <div class="comments list-group">
                        <h4>Commentaires :</h4>
                        <?php foreach ($post->getComments() as $comment): ?>
                            <div class="comment list-group-item">
                                <p>Posté par <?= $comment->getFullName() ?> le <?= $comment->getCreatedAt() ?></p>
                                <p><?= $comment->getContent() ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($session->isAuth()): ?>
                    <p>Rédiger un commentaire :</p>
                    <form action="<?= Template::getBasePath() ?>/create-comment" id="create-comment" method="post">
                        <input type="hidden" id="postId" name="postId" value="<?= $post->getId() ?>">
                        <textarea name="commentContent" id="commentContent"
                                  placeholder="Rédiger un commentaire..." rows="4" cols="50"></textarea>
                        <input type="submit" value="Envoi">
                    </form>
                <?php endif; ?>
                <?php if (isset($formError)): ?>
                    <div class="login-error alert-danger">
                        <p class="error-message"><?= $formError ?></p>
                    </div>
                <?php endif; ?>

                <?php if (isset($formSuccess)): ?>
                    <div class="login-success alert-success">
                        <p class="success-message"><?= $formSuccess ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>

<hr>

<hr>
<?php require_once 'footer.php'; ?>
