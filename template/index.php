<?php

use App\Helper\Template;
use App\Model\Post;

/**
 * @var Post[] $posts
 */
require_once('head.php');

if (isset($css)){
    echo $css;
}
?>
<!-- Main Content -->
<div id="home" class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto intro">
            <h2>Jason Cooke développeur PHP / Symfony au service du web !</h2>
        </div>
    </div>

    <div>
        <p class="form-intro">Vous pouvez me contacter en remplissant le formulaire de contact ci-dessous : </p>
    </div>

    <div class="row form-wrapper">
        <?php if (isset($formerror)): ?>
            <div class="form-error">
                <p id="form-error" class="error-message"><?= $formerror ?></p>
            </div>
        <?php endif ?>
        <?php if (isset($formsuccess)): ?>
            <div class="form-success">
                <p id="form-success" class="success-message"><?= $formerror ?></p>
            </div>
        <?php endif ?>
        <div class="col-lg-8 col-md-10 form">
            <form action="contact-form" id="contact" method="post">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email">
                <label for="fname">Prénom :</label>
                <input type="text" id="fname" name="fname">
                <label for="lname">Nom :</label>
                <input type="text" id="lname" name="lname">
                <textarea name="message" form="contact" id="message" placeholder="Rédiger un message..."></textarea>
                <input type="submit" value="Envoi">
            </form>
        </div>

    </div>


    <div class="cv-wrapper">
        <p class="cv">Vous pouvez consulter mon C.V <a href="<?= Template::img('/cv-cooke-jason.pdf') ?>">ICI</a></p>
    </div>

</div>

<hr>
<?php require_once('footer.php'); ?>
