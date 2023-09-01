function toggleVisibility () {

    const passwordInput = document.getElementById('password');

    console.log('passwordInput :>> ', passwordInput);

    if (passwordInput.type === 'text') passwordInput.type = 'password';
    else passwordInput.type = 'text';

}

function previewImage (event) {
    let image = document.getElementById('image-preview');
    image.style.display = 'block';
    image.src = URL.createObjectURL(event.target.files[0]);
    console.log(event.target.files);
}