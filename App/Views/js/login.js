const formLogin = document.getElementById('loginForm');
formLogin.addEventListener('submit', (event) => {
    event.preventDefault(); 
    loginUser();
});

function loginUser() {
  const formData = new FormData(formLogin);
  fetch('/cours/Brief-Todolist/login', {
      method: 'POST',
      body: formData
  })
  .then(response =>  {
    if (response.ok) {
    console.log('login successful');
    window.location.href = '/cours/Brief-Todolist/task';
} else {
    console.error('login failed');
}
})
.catch(error => {
console.error('Error:', error);
})};