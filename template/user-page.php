<?php
require_once('head.php');
?>

<!-- Main Content -->
<div id="home" class="container">

    <div class="row">
        <?= var_dump($_SESSION) ?>
        <p>Bienvenue <?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?> </p>
    </div>

    <div class="row">



    </div>


</div>

<hr>
<?php require_once('footer.php'); ?>