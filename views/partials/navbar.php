<nav class="navbar">
    <a href=".">
        <span class="navbar-brand">
            <i class="fa-solid fa-user fa-lg"></i>
            <span>MyContacts</span>
        </span>
    </a>
    <ul class="navbar-list">
        <li class="navbar-item">
            <a href="?section=home" class="navbar-link">Accueil</a>
        </li>

        <?php if (isset($_SESSION['id'])) : ?>

            <li class="navbar-item">
                <a href="?section=contacts" class="navbar-link">Contacts</a>
            </li>

            <li class="navbar-item">
                <a href="?section=logout" class="navbar-link">Déconnexion</a>
            </li>

        <?php else : ?>

            <li class="navbar-item">
                <a href="?section=login" class="navbar-link">Connexion</a>
            </li>

        <?php endif; ?>



    </ul>
</nav>