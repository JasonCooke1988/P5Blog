<?php
require_once('head.php');
?>

<!-- Main Content -->
<div id="create-post" class="container">

    <div>
        <p class="form-intro d-flex justify-content-center">Utilisez ce formulaire pour créer un blog post : </p>
    </div>

    <div class="row form-wrapper">

        <div class="offset-lg-2 col-lg-8 col-md-10 form">
            <form class="d-flex flex-column" action="create-post" id="create-post" method="post">
                <label for="title">Le titre du post :</label>
                <input type="title" id="title" name="title">
                <label for="header">Le chapô du post :</label>
                <input type="header" id="header" name="header">
                <textarea name="content" id="content" placeholder="Rédiger un blog post..." rows="5"></textarea>
                <input type="submit" value="Envoi">
            </form>
        </div>

        <?php if (isset($formError)): ?>
            <div class="form-error">
                <p id="form-error" class="error-message"><?= $formError ?></p>
            </div>
        <?php endif ?>
        <?php if (isset($formSuccess)): ?>
            <div class="form-success">
                <p id="form-success" class="success-message"><?= $formSuccess ?></p>
            </div>
        <?php endif ?>

    </div>

</div>

<hr>
<?php require_once('footer.php'); ?>
