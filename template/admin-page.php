<?php
require_once('head.php');

use App\Helper\Template; ?>

<!-- Main Content -->
<div id="admin-page" class="container">

        <div class="row">
            <p>Bienvenue <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?> tu est un admin</p>
        </div>

        <div class="row">

            <div class="admin-links">
                <ul>
                    <li><a href="<?= Template::getBasePath() ?>/create-post">Rédiger un blog post</a></li>
                    <li><a href="<?= Template::getBasePath() ?>/modify-post">Gérer blog posts / commentaires</a></li>
                </ul>
            </div>

        </div>

</div>

<hr>
<?php require_once('footer.php'); ?>
