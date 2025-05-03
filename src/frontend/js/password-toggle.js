function togglePasswordVisibility() {
  const passwordInput = document.getElementById('inputPassword');
  const icon = document.querySelector('.toggle-password');
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.remove('bi-eye-slash');
    icon.classList.add('bi-eye');
  } else {
    passwordInput.type = 'password';
    icon.classList.remove('bi-eye');
    icon.classList.add('bi-eye-slash');
  }
}
