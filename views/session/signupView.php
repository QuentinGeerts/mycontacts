<div class="signup-form">
    <form id="signup-form" action="?section=signup" method="post">

        <h1>Inscription</h1>

        <?php if ($error) {
            echo "<div class='alert'>$error_message</div>";
        } ?>

        <input type="text" name="lastname" id="lastname" placeholder="Nom" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
        <input type="date" name="birthdate" id="birthdate" placeholder="Date de naissance" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>">

        <!-- <label for="email">Email :</label> -->
        <input type="text" name="email" id="email" autocomplete="off" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">

        <!-- <label for="password">Mot de passe :</label> -->
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirmer le mot de passe">

        <button type="submit" name="signup">S'inscrire</button>
    </form>
</div>