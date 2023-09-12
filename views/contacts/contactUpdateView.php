<div class="contact-update">

    <?php if (!empty($contact)) : ?>

        <form id="updateForm" action="?section=contact-update" method="post" enctype="multipart/form-data">

            <?php if (isset($error) && $error && !empty($error_message)) {
                echo "<div class='alert'>$error_message</div>";
            } ?>


            <div class="form-group">
                <div class="group-icon">
                    <i class="fa-regular fa-image"></i>
                </div>
                <div class="group-field">
                    <label for="contact-image" class="contact-image-wrapper">
                        <input type="file" name="contact-image" id="contact-image" onchange="previewImage(event)"
                               accept=".png, .jpg, .jpeg">

                        <?php if ($contact['filepath']) : ?>
                            <span id="contact-image-text" class="d-none"><i class="fa-solid fa-upload"></i> Télécharger une image</span>
                            <img id="image-preview" src="<?= $contact['filepath'] . $contact['filename'] ?>"
                                 alt="Image Preview" class="d-block">
                        <?php else: ?>
                            <span id="contact-image-text" class="d-block"><i class="fa-solid fa-upload"></i> Télécharger une image</span>
                            <img id="image-preview" src="<?= $contact['filepath'] . $contact['filename'] ?>"
                                 alt="Image Preview" class="d-none">
                        <?php endif; ?>
                    </label>

                    <input type="hidden" name="filepath" value="<?= $contact['filepath'] ?>">
                    <input type="hidden" name="filename" value="<?= $contact['filename'] ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="group-icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="group-field">
                    <input type="text" name="lastname" id="lastname" placeholder="Nom" required
                           value="<?= $contact['lastname'] ?>">
                    <input type="text" name="firstname" id="firstname" placeholder="Prénom" required
                           value="<?= $contact['firstname'] ?>">
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo (optionnel)"
                           value="<?= $contact['pseudo'] ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="group-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="group-field">
                    <input type="text" name="phone_number" id="phone_number" placeholder="Téléphone (optionnel)"
                           value="<?= $contact['phone_number'] ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="group-icon">
                    <i class="fa-solid fa-at"></i>
                </div>
                <div class="group-field">
                    <input type="text" name="email" id="email" placeholder="Email (optionnel)"
                           value="<?= $contact['email'] ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="group-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="group-field">
                    <input type="text" name="street_address" id="street_address" placeholder="Rue (optionnel)"
                           value="<?= $contact['street_address'] ?>">
                    <input type="text" name="number_address" id="number_address" placeholder="Numéro (optionnel)"
                           value="<?= $contact['number_address'] ?>">
                    <input type="text" name="zip_address" id="zip_address" placeholder="Code postal (optionnel)"
                           value="<?= $contact['zip_address'] ?>">
                    <input type="text" name="city_address" id="city_address" placeholder="Ville (optionnel)"
                           value="<?= $contact['city_address'] ?>">
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $contact['id']; ?>">

            <button type="submit" name="contact-update" form="updateForm">Modifier</button>
        </form>

    <?php else: ?>

        <p>Aucun contact sélectionné</p>

    <?php endif; ?>

</div>

<script src="assets/js/previewImage.js"></script>
