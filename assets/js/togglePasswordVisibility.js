function toggleVisibility () {
    const passwordInput = document.getElementById('password');

    if (passwordInput.type === 'text') passwordInput.type = 'password';
    else passwordInput.type = 'text';

}