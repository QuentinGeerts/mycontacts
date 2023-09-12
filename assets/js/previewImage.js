function previewImage (event) {
    let image = document.getElementById('image-preview');
    image.style.display = 'block';
    image.src = URL.createObjectURL(event.target.files[0]);
    console.log(event.target.files);
    let text = document.getElementById('contact-image-text');
    text.style.display = 'none';
}