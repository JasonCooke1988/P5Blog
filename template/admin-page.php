<?php
include 'head.php';

use App\Helper\Template; ?>

<!-- Main Content -->
<div id="admin-page" class="container">

        <div class="row">
            <p>Bienvenue <?= $session->getFullName() ?> tu est un admin</p>
        </div>

        <div class="row">

            <div class="admin-links">
                <ul>
                    <li><a href="<?= Template::getBasePath() ?>/create-post">Rédiger un blog post</a></li>
                    <li><a href="<?= Template::getBasePath() ?>/modify-post">Gérer blog posts / commentaires</a></li>
                    <li><a href="<?= Template::getBasePath() ?>/user-list">Liste des utilisateurs</a></li>
                </ul>
            </div>

        </div>

</div>

<hr>
<?php include 'footer.php'; ?>
