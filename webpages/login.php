<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../includes/helper.php");

    $email = htmlspecialchars($_POST["email"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST["password"]);

    if (is_email_empty($email)) {
        // display error
        header("Location: login.php");
        exit();
    }

    $query = "SELECT hash FROM users WHERE email = '$email';";
    $hashed_password = db_select_query($query)[0]["hash"];
    
    if (password_verify($password, $hashed_password)) {
        $id = get_user_id($email);
        session_start();
        $_SESSION["user_id"] = $id;

        header("Location: ../index.php");
        exit();
    } else {
        // display error
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>MossFood Login</title>
    <link rel="website icon" type="png" href="../images_resources/mossfood_logo.jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/login.css">
    <script src="../scripts/login_script.js"></script>
</head>

<body>

    <div class="login">
        <div class="loginImg">
            <img src="http://localhost/moosfood/images_resources/mossfood_logo.jpeg" alt="Login Image">
        </div>

        <div class="loginForm">
            <h5>Log in</h5>
            <form action="login.php" method="post" onsubmit="return ValidateLoginForm()" id="loginForm">
                <input type="text" id="email" name="email" placeholder="Enter your email" required>
                <div id="emailError" style="color: red;"></div>

                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div id="passwordError" style="color: red;"></div>
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">Show Password</span>
                <br><button type="submit">Log In</button></br>
            </form>
            <br><a href="../webpages/signup.php">Already haven't an account? Click here to signup</a></br>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(passwordFieldId) {
            const passwordField = document.getElementById(passwordFieldId);
            const toggleText = passwordField.type === "password" ? "Hide Password" : "Show Password";
            document.querySelector('.password-toggle').textContent = toggleText;
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
