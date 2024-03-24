const formRegister = document.getElementById('registerForm');
const errorMessage = document.getElementById('error-message');

formRegister.addEventListener('submit', (event) => {
    event.preventDefault();
    registerUser();
});

function registerUser() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password !== confirmPassword) {
        displayErrorMessage('Passwords do not match. Please try again.');
        return;
    }

    const formData = new FormData(formRegister);
    fetch('/cours/Brief-Todolist/register', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Registration successful');
            window.location.href = '/cours/Brief-Todolist/login';
        } else {
            displayErrorMessage(data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayErrorMessage('An error occurred. Please try again later.');
    });
}

function displayErrorMessage(message) {
    errorMessage.textContent = message;
    errorMessage.style.display = 'block';
}