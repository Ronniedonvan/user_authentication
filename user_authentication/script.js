function showForm(formId) {
    // Hide all forms
    document.querySelectorAll('.form').forEach(form => form.classList.add('hidden'));

    // Show the selected form
    document.getElementById(formId).classList.remove('hidden');
}

document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let username = document.getElementById('signup-username').value;
    let email = document.getElementById('signup-email').value;
    let password = document.getElementById('signup-password').value;

    // AJAX request to signup.php
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'signup.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('signup-message').textContent = xhr.responseText;
    };
    xhr.send('username=' + username + '&email=' + email + '&password=' + password);
});

document.getElementById('signin-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let email = document.getElementById('signin-email').value;
    let password = document.getElementById('signin-password').value;

    // AJAX request to signin.php
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'signin.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('signin-message').textContent = xhr.responseText;

        // Assuming successful login, show the profile
        if (xhr.responseText.trim() === 'Login successful') {
            showForm('profile-form');
        }
    };
    xhr.send('email=' + email + '&password=' + password);
});

document.getElementById('forgot-password-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let email = document.getElementById('forgot-password-email').value;

    // AJAX request to forgot_password.php
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'forgot_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('forgot-password-message').textContent = xhr.responseText;
    };
    xhr.send('email=' + email);
});

document.getElementById('reset-password-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let token = document.getElementById('reset-token').value;
    let password = document.getElementById('reset-password').value;

    // AJAX request to reset_password.php
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'reset_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('reset-password-message').textContent = xhr.responseText;
    };
    xhr.send('token=' + token + '&password=' + password);
});
