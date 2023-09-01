<div class="contact-add">

    <form action="?section=contact-add" method="post" enctype="multipart/form-data">


        <div class="form-group">
            <div class="group-icon">
                <i class="fa-regular fa-image"></i>
            </div>
            <div class="group-field">
                <label for="contact-image" class="contact-image-wrapper">
                        <i class="fa-solid fa-upload"></i> Télécharger une image
                    <input type="file" name="contact-image" id="contact-image" onchange="previewImage(event)">
                    <img id="image-preview" src="../img/avatar.png" alt="Image Preview">
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
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="group-field">
                <input type="text" name="phone_number" id="phone_number" placeholder="Téléphone">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-at"></i>
            </div>
            <div class="group-field">
                <input type="text" name="email" id="email" placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <div class="group-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="group-field">
                <input type="text" name="street_address" id="street_address" placeholder="Rue">
                <input type="text" name="number_address" id="number_address" placeholder="Numéro">
                <input type="text" name="zip_address" id="zip_address" placeholder="Code postal">
                <input type="text" name="city_address" id="city_address" placeholder="Ville">
            </div>
        </div>

        <button type="submit" name="contact-add">Créer</button>
    </form>

</div>