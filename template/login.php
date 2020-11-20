<?php
require_once('head.php');
?>

<!-- Main Content -->
<div id="home" class="container">

    <div class="row">
        <p>Veuillez utiliser les formulaires ci-dessous pour vous connecter à votre compte utilisateur ou créer un
            compte.</p>
    </div>

    <div class="row">

        <div class="create-account-form offset-lg-2 col-lg-4">

            <h2>Création de compte : </h2>
            <form action="create-account" id="createaccount" method="post">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email">
                <label for="fname">Prénom :</label>
                <input type="text" id="fname" name="fname">
                <label for="lname">Nom :</label>
                <input type="text" id="lname" name="lname">
                <label for="password">Mot de passe :</label>
                <input type="text" id="password" name="password">
                <label for="password2">Confirmer mot de passe :</label>
                <input type="text" id="password2" name="password2">
                <input type="submit" value="Envoi">
            </form>

            <?php if (isset($createError)): ?>
                <div class="create-error">
                    <p class="error-message"><?= $createError ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($createSuccess)): ?>
                <div class="create-success">
                    <p class="success-message"><?= $createSuccess ?></p>
                </div>
            <?php endif; ?>
        </div>


        <div class="login-form offset-lg-2 col-lg-4">

            <h2>Connexion compte : </h2>
            <form action="login-account" id="login" method="post">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email">
                <label for="password">Mot de passe :</label>
                <input type="text" id="password" name="password">
                <label for="password2">Confirmer mot de passe :</label>
                <input type="text" id="password2" name="password2">
                <input type="submit" value="Envoi">
            </form>

            <?php if (isset($loginError)): ?>
                <div class="login-error">
                    <p class="error-message"><?= $loginError ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($loginSuccess)): ?>
                <div class="login-success">
                    <p class="success-message"><?= $loginSuccess ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>


</div>

<hr>
<?php require_once('footer.php'); ?>
