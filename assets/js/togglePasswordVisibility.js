function toggleVisibility () {

    const passwordInput = document.getElementById('password');

    console.log('passwordInput :>> ', passwordInput);

    if (passwordInput.type === 'text') passwordInput.type = 'password';
    else passwordInput.type = 'text';

}