<?php
// Simulating dynamic values for the popup
$order_id = "12345";
$product_id = "67890";
$quantity = 3;
$price = 59.99;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Added</title>
    <link rel="stylesheet" href="http://localhost/moosfood/styles/popup.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="popup" id="popup">
        <div class="success-icon">✔️</div>
        <h2>Product has been successfully added to your Order History!</h2>
       
        <a href="http://localhost/moosfood/webpages/orderhistory.php"><h3>Return to Order History</h3>
    </div>

    <script>
        // Close the popup when the user clicks anywhere on the screen
        document.addEventListener("click", function() {
            document.getElementById('popup').style.display = 'none';
        });
    </script>
</body>
</html>
