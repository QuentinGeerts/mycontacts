<h1>Connexion</h1>
<form id="login-form" action="?section=login" method="post">

    <?php

    if ($error) {
        echo "<p>$error_message</p>";
    }

    ?>

    <label for="email">Email :</label>
    <input type="text" name="email" id="email" autocomplete="off">

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">

    <div>
        <input type="checkbox" name="toggle-visibility" id="toggle-visibility"  oninput="toggleVisibility()">
        <label for="toggle-visibility">Afficher le mot de passe</label>
    </div>

    <button type="submit" name="login">Se connecter</button>
</form>