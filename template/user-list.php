<?php

use App\Helper\Template;
use App\Model\Post;

/**
 * @var Post[] $posts
 */
include 'head.php';
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
            <p>Cliquez sur "Désigner comme administrateur" pour définir cet utilisateur en tant que administrateur</p>
            <div class="users list-group">
            <?php
            foreach ($users as $user):
                ?>
            <?php if(!$user->isRoleAdmin()): ?>
                <div class="list-group-item user d-flex justify-content-around">
                        <p class="m-0"><?= $user->getFullName() ?></p>
                    <form action="<?= Template::getBasePath() . '/user-list/' . $user->getId() ?>" id="set-admin" method="post">
                        <input type="submit" value="Désigner comme administrateur">
                    </form>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<hr>
<?php include 'footer.php'; ?>
