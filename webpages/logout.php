<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Optionally, you can unset all session variables as well
$_SESSION = array();

// Display a small logout notice before redirecting using a PHP form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="http://localhost/moosfood/styles/logout.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="logout-message">
        <h2>You have been logged out</h2>
        <p>Redirecting to login page...</p>
    </div>

    <form id="redirectForm" action="http://localhost/moosfood/webpages/login.php" method="get">
        <input type="hidden" name="logout" value="true">
    </form>

    <script>
        // Submit the form after a short delay (e.g., 3 seconds)
        setTimeout(function(){
            document.getElementById('redirectForm').submit();
        }, 3000);
    </script>
</body>
</html>
<?php
exit();
?>
