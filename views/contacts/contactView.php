<?php if ($error) {
    echo "<div class='alert'>$error_message</div>";
} ?>

<button class="btn-add-contact">
    <a href="?section=contact-add">
        <i class="fa fa-solid fa-plus fa-lg"></i>
        Créer un contact
    </a>
</button>

<div class="contacts">
    <?php if (!empty($contacts) && count($contacts) > 0) : ?>

        <?php foreach ($contacts as $contact) : ?>

            <div class="contact-row">
                <div class="contact-info-div">
                    <div class="contact-img">
                        <img src="<?= $contact['filepath'] . $contact['filename'] ?>" alt="$contact['lastname'] . ' ' . $contact['firstname']">
                    </div>
                    <div class="contact-name">
                        <div class="bold" title="<?= $contact['pseudo'] ?>">
                            <?= $contact['lastname'] . ' ' . $contact['firstname'] ?>
                        </div>
                    </div>
                    <div class="contact-info">
                        <div><span class="bold">Tel : </span><?= $contact['phone_number'] ?></div>
                        <div><span class="bold">Email : </span><?= $contact['email'] ?></div>
                    </div>
                </div>
                <form action="?section=contacts" method="post">
                    <div class="contact-options">
                        <div class="contact-update">
                            <button type="button" name="update">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </button>
                        </div>
                        <div class="contact-delete">
                            <button name="delete" value="<?= $contact['id'] ?>" onClick="javascript: return confirm('Voulez-vous supprimer <?= $contact['lastname'] . ' ' . $contact['firstname'] ?>');">
                                <i class="fa-solid fa-trash fa-lg"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <?php endforeach; ?>

    <?php else : ?>

        <p>Aucun contact trouvé</p>

    <?php endif; ?>

</div>