<?php
include 'head.php';

use App\Helper\Template; ?>

<div class="404-error">
    <p class="error-text d-flex justify-content-center">Cette page n'existe pas. Cliquez <a class="px-2" href="<?= Template::getBasePath() ?>">ICI</a> pour retourner a l'accueil</p>
</div>

<?php include 'footer.php'; ?>
