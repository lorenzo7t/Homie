async function checkPassword() {
  if (password.length < 8) {
  var passwordError = 'Password must be at least 8 characters long';
  }
  const passwordRegex =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if (!passwordRegex.test(password)) {
        var passwordError = 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character';
        }

    if (passwordError) {
        document.getElementById('password_error').innerHTML = passwordError;
    }
    const password1= document.getElementById('password').value;
    const password2= document.getElementById('confirm_password').value;
    if (password1 != password2) {
        var passwordError = 'Passwords do not match';
        document.getElementById('password_error').innerHTML = passwordError;
    }
    
  
}