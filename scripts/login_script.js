function emailValidation(email) {
    var emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return emailPattern.test(email);
  }
  
  document
    .getElementById("password")
    .addEventListener("keypress", function (event) {
      // Check if the "Enter" key is pressed (keyCode 13) or (which 13)
      if (event.keyCode === 13 || event.which === 13) {
        // Prevent the default action of the "Enter" key (form submission)
        event.preventDefault();
        if (ValidateLoginForm()) document.getElementById("loginForm").submit();
      }
    });
  
  document
    .getElementById("signupPassword")
    .addEventListener("keypress", function (event) {
      // Check if the "Enter" key is pressed (keyCode 13) or (which 13)
      if (event.keyCode === 13 || event.which === 13) {
        // Prevent the default action of the "Enter" key (form submission)
        event.preventDefault();
        if (ValidateSignupForm()) document.getElementById("signupForm").submit();
      }
    });

function ValidateSignupForm() {
    const username = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("signupPassword").value;

    var emailError = document.getElementById("emailError");
    var nameError = document.getElementById("nameError");
    var passwordError = document.getElementById("passwordError");
    
    emailError.innerHTML = "";
    nameError.innerHTML = "";
    passwordError.innerHTML = "";

    if (username.trim() === '') {
        nameError.innerHTML = "Name is required";
        document.getElementById("name").focus();
        return false;
    } 

    if (email.trim() === '') {
        emailError.innerHTML = "Invalid email format";
        document.getElementById("email").focus();
        return false;
    }

    const passwordPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if (passwordValue === '') {
        setError(password, 'Password is required');
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be at least 8 characters.');
    } else if (!passwordPattern.test(password)) {
        passwordError.innerHTML = "Password contains invalid characters";
        document.getElementById("signupPassword").focus();
        return false;
    }
    function toggleMenu() {
      var menu = document.getElementById("menuItems");
      if (menu.classList.contains("active")) {
          menu.classList.remove("active");
      } else {
          menu.classList.add("active");
      }
  }
  
  
    return true;
};

