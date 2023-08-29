<?php if ($error) {
    echo "<p>$error_message</p>";
} ?>

<div class="contacts">
    <?php if ($contacts && count($contacts) > 0) : ?>

        <?php foreach ($contacts as $contact) : ?>

            <div class="contact-row">
                <div class="contact-info-div">
                    <div class="contact-img"></div>
                    <div class="contact-name">
                        <div class="bold" title="<?= $contact['pseudo'] ?>">
                            <?= $contact['lastname'] . ' ' . $contact['firstname'] ?>
                        </div>
                    </div>
                    <div class="contact-info">
                        <div><span class="bold">Tel :</span><?= $contact['phone_number'] ?></div>
                        <div><span class="bold">Email :</span><?= $contact['email'] ?></div>
                    </div>
                </div>
                <div class="contact-options">
                    <div class="contact-update">
                        <button>
                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                        </button>
                    </div>
                    <div class="contact-delete">
                        <button>
                            <i class="fa-solid fa-trash fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    <?php else : ?>

        <p>Aucun contact trouvé</p>

    <?php endif; ?>
</div>