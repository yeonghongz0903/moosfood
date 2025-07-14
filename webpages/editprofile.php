<?php 
    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();

    $user_id = get_user_id_session();
    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $user_data = db_select_query($query)[0];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the input data
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET username = ?, email = ?, hash = ? WHERE user_id = ?;";
        $var_type = "sssi";
        $params = array($username, $email, $hashed_password, $user_id);

        db_update_query($query, $var_type, $params);    
        header("Location: ../index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../styles/profile.css"> <!-- Link to your CSS -->
</head>
<body>
<div class="profile-container"> <!-- Centering container -->
    <div class="profile">
        <h1>Edit Profile</h1>
        <?php
        // Display user profile form
        if (isset($user_data)) {
            echo "<form action='editprofile.php' method='post' onsubmit='return validateSignupForm();'>"; // Corrected action
            echo "<p><strong>Username:</strong> <input type='text' id='username' name='username' value='" . htmlspecialchars($user_data['username']) . "' required></p>";
            echo "<p><strong>Email:</strong> <input type='email' id='email' name='email' value='" . htmlspecialchars($user_data['email']) . "' required></p>";
            echo "<p><strong>Password:</strong> <input type='text' name='password' value=''></p>";
            echo "<button type='submit'>Save Changes</button>";
            echo "</form>";
        } else {
            echo "<p>User not found.</p>";
        }
        ?>
        <br><a href="profile.php"><button type="button">Back to Profile</button></a>
    </div>
</div>

<script>
function validateSignupForm() {
    const email = document.getElementById("email").value;
    const emailError = document.getElementById("emailError");

    emailError.innerHTML = "";

    if (!emailValidation(email)) {
        emailError.innerHTML = "Invalid email format";
        document.getElementById("email").focus();
        return false;
    }

    return true;
}

function emailValidation(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format validation
    return regex.test(email);
}
</script>

</body>
<?php include("../includes/templates/footer.php"); ?>
</html>
