const passwordField = document.getElementById('password');
const re_passwordField = document.getElementById('password-repeat');
const sumbitButton = document.getElementsByTagName('button')[0];

re_passwordField.addEventListener('input', function() {

    if (passwordField.value === re_passwordField.value) {
        sumbitButton.disabled = false;
    } else {
        sumbitButton.disabled = true;
    }

});
