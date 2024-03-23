const formRegister = document.getElementById('registerForm');
formRegister.addEventListener('submit', (event) => {
    event.preventDefault(); 
    registerUser();
});



function registerUser() {
  const formData = new FormData(formRegister);
  fetch('/cours/Brief-Todolist/register', {
      method: 'POST',
      body: formData
  })
  .then(response => {
      if (response.ok) {
          console.log('Registration successful');
          window.location.href = '/cours/Brief-Todolist/login';
      } else {
          console.error('Registration failed');
      }
  })
  .catch(error => {
      console.error('Error:', error);
  });
}




