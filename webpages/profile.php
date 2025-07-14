<?php 
    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();
    
    $user_id = get_user_id_session();
    $query = "SELECT * FROM users WHERE user_id = '$user_id';";
    $user_data = db_select_query($query)[0];
    
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../styles/profile.css">
</head>
<body>
    <div class="profile container">
        <?php

        // Display user profile
        if (isset($user_data)) {
            echo "<h1>User Profile</h1>";
            echo "<p><strong>Username:</strong> " . htmlspecialchars($user_data['username']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($user_data['email']) . "</p>";
        } else {
            echo "<p>User not found.</p>";
        }

        ?>
        <br>
        <a href="editprofile.php">
            <button type="button">Edit Profile</button>
        </a>
        <br>

    </div> 
</body>
<?php include("../includes/templates/footer.php"); ?>
</html>