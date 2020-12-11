<?php
require_once('head.php');

use App\Helper\Template; ?>

<!-- Main Content -->
<!-- Post Content -->
<article>
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2>Utilisez le formulaire ci-dessous pour modifier le blog post :</h2>
                <form class="d-flex flex-column" action="<?= Template::getBasePath() . '/modify-post/' . $post->getId() ?>" id="create-comment"
                      method="post">
                    <input type="hidden" id="postId" name="postId" value="<?= $post->getId() ?>">
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="<?= $post->getTitle() ?>">
                    <label for="header">Chapo :</label>
                    <input type="text" id="header" name="header" value="<?= $post->getHeader() ?>">
                    <label for="content">Contenu :</label>
                    <textarea name="content" id="content" rows="5"><?= $post->getContent() ?></textarea>
                    <input type="submit" name="modify" value="Envoi">
                    <input type="submit" name="delete" value="Supprimer">
                </form>
                <?php if (isset($formError)): ?>
                    <div class="form-error alert-danger">
                        <p id="form-error" class="error-message"><?= $formError ?></p>
                    </div>
                <?php endif ?>
                <?php if (isset($formSuccess)): ?>
                    <div class="form-success alert-success">
                        <p id="form-success" class="success-message"><?= $formSuccess ?></p>
                    </div>
                <?php endif ?>
            </div>
            <?php if (!empty($comments)): ?>
                <div class="mt-2 list-group col-md-10 mx-auto">
                    <h3>Les commentaires liées à ce poste en attente de validation :</h3>
                    <?php foreach ($comments as $comment): ?>
                    <div class="comment list-group-item">
                        <p>Créer par <?= $comment->getFullName() ?> le <?= $comment->getCreatedAt() ?></p>
                        <p><?= $comment->getContent() ?></p>
                        <form action="<?= Template::getBasePath() . '/validate-comment/' . $comment->getId() . '/' . $post->getId() ?>"
                              id="validate-comment" method="post">
                            <input type="submit" name="validate" value="Valider">
                            <input type="submit" name="delete" value="Supprimer">
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>

<hr>

<hr>
<?php require_once('footer.php'); ?>
