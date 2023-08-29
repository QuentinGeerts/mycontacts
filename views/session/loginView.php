<form id="login-form" action="?section=login" method="post">

    <h1>Connexion</h1>

    <?php if ($error) {
        echo "<p>$error_message</p>";
    } ?>

    <!-- <label for="email">Email :</label> -->
    <input type="text" name="email" id="email" autocomplete="off" placeholder="Email" value="<?= $_POST['email'] ? $_POST['email'] : '' ?>">

    <!-- <label for="password">Mot de passe :</label> -->
    <input type="password" name="password" id="password" placeholder="Mot de passe">

    <div>
        <input type="checkbox" name="toggle-visibility" id="toggle-visibility" oninput="toggleVisibility()">
        <label for="toggle-visibility">Afficher le mot de passe</label>
    </div>

    <button type="submit" name="login">Se connecter</button>
</form>