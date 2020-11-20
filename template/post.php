<?php
require_once('head.php');
?>

<!-- Main Content -->
<!-- Post Content -->
<article>
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="section-heading"><?= $post->getTitle() ?></h2>
                <h3><?= $post->getHeader() ?> <br>
                <small>Créer par <?= $post->getFullName() ?> le <?= $post->getCreatedAt() ?>
                <?= $post->getUpdatedAt() !== null ? 'et modifié le ' . $post->getUpdatedAt() : "" ?></small></h3>

               <p> <?= $post->getContent() ?></p>

                <?php if (isset($_SESSION['auth']) && $_SESSION['auth']): ?>
                <p>Rédiger un commentaire :</p>
                <form action="<?= $url ?>/create-comment" id="create-comment" method="post">
                    <input type="hidden" id="postId" name="postId" value="<?= $post->getId() ?>">
                    <textarea name="commentContent" id="commentContent" placeholder="Rédiger un commentaire..."></textarea>
                    <input type="submit" value="Envoi">
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>

<hr>

<hr>
<?php require_once('footer.php'); ?>
