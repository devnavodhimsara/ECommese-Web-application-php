document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Validation logic (check if email is valid, password is strong, etc.)
    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const mobileNumber = document.getElementById('mobile_number').value;

    let isValid = true;

    // Basic validation (you can add more rules)
    if (firstName.length < 2) {
        document.getElementById('first_name_error').textContent = 'First name must be at least 2 characters.';
        isValid = false;
    } else {
        document.getElementById('first_name_error').textContent = '';
    }

    if (lastName.length < 2) {
        document.getElementById('last_name_error').textContent = 'Last name must be at least 2 characters.';
        isValid = false;
    } else {
        document.getElementById('last_name_error').textContent = '';
    }

    if (!validateEmail(email)) {
        document.getElementById('email_error').textContent = 'Invalid email format.';
        isValid = false;
    } else {
        document.getElementById('email_error').textContent = '';
    }

    if (password.length < 8) {
        document.getElementById('password_error').textContent = 'Password must be at least 8 characters.';
        isValid = false;
    } else {
        document.getElementById('password_error').textContent = '';
    }

    if (mobileNumber.length !== 10 || !isNumeric(mobileNumber)) {
        document.getElementById('mobile_number_error').textContent = 'Invalid mobile number.';
        isValid = false;
    } else {
        document.getElementById('mobile_number_error').textContent = '';
    }

    if (isValid) {
        // Submit the form if validation passes
        this.submit();
    }
});

function validateEmail(email) {
    // Regular expression for email validation
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function isNumeric(str) {
    return /^\d+$/.test(str);
}