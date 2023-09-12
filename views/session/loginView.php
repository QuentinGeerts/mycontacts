<div class="login-form">
    <form id="login-form" action="?section=login" method="post">

        <h1>Connexion</h1>

        <?php if ($error) {
            echo "<div class='alert'>$error_message</div>";
        } ?>

        <!-- <label for="email">Email :</label> -->
        <input type="text" name="email" id="email" autocomplete="off" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">

        <!-- <label for="password">Mot de passe :</label> -->
        <input type="password" name="password" id="password" placeholder="Mot de passe">

        <div>
            <input type="checkbox" name="toggle-visibility" id="toggle-visibility" oninput="toggleVisibility()">
            <label for="toggle-visibility">Afficher le mot de passe</label>
        </div>

        <button type="submit" name="login">Se connecter</button>

        <p>Vous n'êtes pas encore inscrit ? Inscrivez-vous <a href="?section=signup">ici</a>.</p>
    </form>
</div>

<script src="/assets/js/togglePasswordVisibility.js"></script>