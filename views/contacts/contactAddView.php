<div class="contact-add">

    <form action="?section=contact-add" method="post" enctype="multipart/form-data">

        <?php if ($error) {
            echo "<div class='alert'>$error_message</div>";
        } ?>


        <div class="form-group">
            <div class="group-icon">
                <i class="fa-regular fa-image"></i>
            </div>
            <div class="group-field">
                <label for="contact-image" class="contact-image-wrapper">
                    <span id="contact-image-text"><i class="fa-solid fa-upload"></i> Télécharger une image</span>
                    <input type="file" name="contact-image" id="contact-image" onchange="previewImage(event)"
                           accept=".png, .jpg, .jpeg">
                    <img id="image-preview" src="assets/img/avatar.png" alt="Image Preview">
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="group-field">
                <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
                <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo (optionnel)">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="group-field">
                <input type="text" name="phone_number" id="phone_number" placeholder="Téléphone (optionnel)">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-at"></i>
            </div>
            <div class="group-field">
                <input type="text" name="email" id="email" placeholder="Email (optionnel)">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="group-field">
                <input type="text" name="street_address" id="street_address" placeholder="Rue (optionnel)">
                <input type="text" name="number_address" id="number_address" placeholder="Numéro (optionnel)">
                <input type="text" name="zip_address" id="zip_address" placeholder="Code postal (optionnel)">
                <input type="text" name="city_address" id="city_address" placeholder="Ville (optionnel)">
            </div>
        </div>

        <button type="submit" name="contact-add">Créer</button>
    </form>

</div>

<script src="assets/js/previewImage.js"></script>