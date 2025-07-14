<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../includes/helper.php");

        $username = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!is_email_empty($email)) {
            // Todo: Display duplicate email error message
            header("Location: signup.php");
            exit();
        }
        
        else {
            $password = htmlspecialchars($_POST["signupPassword"]);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (username, email, hash) VALUES (?, ?, ?);";
            $var_type = "sss";
            $params = array($username, $email, $hashed_password);
    
            db_update_query($query, $var_type, $params);
    
            header("Location: login.php");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup.css">
    <script src="../scripts/login_script.js"></script>
</head>

<body>
    <div class="signup">
        <div class="signupImg">
            <!-- Optionally, add an image here -->
            <img src="http://localhost/moosfood/images_resources/mossfood_logo.jpeg" alt="Signup Image">
        </div>
        <div class="signupForm">
            <form id="signupForm" action="signup.php" method="post" onsubmit="return validateSignupForm()">
                <h5>Sign up</h5>
                <div class="input-control">
                    <input type="text" id="name" name="name" placeholder="Name" autocomplete="name" required>
                    <div id="nameError" style="color: red;"></div>
                </div>
                <div class="input-control">
                    <input type="text" id="email" name="email" placeholder="Enter your email or phone number"
                    autocomplete="email" required>
                    <div id="emailError" style="color: red;"></div>
                </div>
                <div class="input-control">
                    <input type="password" id="signupPassword" name="signupPassword"
                        placeholder="Enter your password" autocomplete="new-password" required>
                    <div id="passwordError" style="color: red;"></div>
                    <td><span class="password-toggle" onclick="signupTogglePasswordVisibility()">Show Password</span></td>
                </div>
                <br><button type="submit">Create Account</button></br>
            </form><br>
            <a href="login.php">Already have an account? Click here to login</a></br>
        </div>
    </div>

    <script>
        function validateSignupForm() {
            const email = document.getElementById("email").value;
            const password = document.getElementById("signupPassword").value;

            var emailError = document.getElementById("emailError");
            var passwordError = document.getElementById("passwordError");

            emailError.innerHTML = "";
            passwordError.innerHTML = "";

            if (!emailValidation(email)) {
                emailError.innerHTML = "Invalid email format";
                document.getElementById("email").focus();
                return false;
            }

            if (password.trim() === "") {
                passwordError.innerHTML = "Password is required";
                document.getElementById("signupPassword").focus();
                return false;
            }

            return true;
        }

        function emailValidation(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function signupTogglePasswordVisibility() {
            const passwordField = document.getElementById("signupPassword");
            const toggleText = passwordField.type === "password" ? "Hide Password" : "Show Password";
            document.querySelector('.password-toggle').textContent = toggleText;
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
