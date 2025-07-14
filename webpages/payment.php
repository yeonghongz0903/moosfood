<?php 

    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();

    $user_id = get_user_id_session();
    $products = get_products_from_cart($user_id);
    $total = 0;
    $items_quantity = array();

    foreach ($products as &$product) {
        $product_id = $product['product_id'];
        $query = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id';";
        $quantity = db_select_query($query);

        $product['quantity'] = $quantity[0]['quantity'];
        $product['total_price'] = $product['quantity'] * $product['price'];
        $total += $product['total_price'];
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .billing-details, .order-summary {
            width: 48%;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .billing-details h2, .order-summary h2 {
            margin-bottom: 20px;
        }
        .billing-details input[type="text"], 
        .billing-details input[type="email"], 
        .billing-details input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .order-summary .product {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total {
            font-size: 1.2em;
            margin-top: 20px;
            text-align: right;
        }
        .payment-methods {
            margin-top: 20px;
        }
        .payment-methods input[type="radio"] {
            margin-right: 10px;
        }
       
        .buttons {
            margin-top: 20px;
            text-align: right;
        }
        .buttons button {   
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
      <head><link rel="stylesheet" href="styles/payment.css"></head>
</head>
<body>

<div class="container">
    <div class="billing-details">
        <h2>Billing Details</h2>
        <form action="../index.php" method="post">
            <label for="full_name">Full Name*</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="street_address">Street Address*</label>
            <input type="text" id="street_address" name="street_address" required>

            <label for="apartment">Apartment, floor, etc. (optional)</label>
            <input type="text" id="apartment" name="apartment">

            <label for="town_city">Town/City*</label>
            <input type="text" id="town_city" name="town_city" required>

            <label for="phone_number">Phone Number*</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>

            <label for="save_info">Save this information for faster check-out next time</label>
            <input type="checkbox" id="save_info" name="save_info">

            <input type="hidden" name="order">
            <div class="buttons">
                <button type="submit">Place Order</button>
            </div>
        </form>
    </div>

    <div class="order-summary">
        <h2>Your Order</h2>
        <hr>

        <?php foreach($products as &$product): ?>
            <div class="product">
                <span> <?= $product['product_name'] . " x  " . $product['quantity']; ?> </span>
                <span> <?= "RM " . $product['total_price']; ?> </span>

            </div>
        <?php endforeach; ?>

        <hr>

        <div class="product">
            <span>Shipping</span>
            <span>RM 0</span>
        </div>
        <div class="total">
            <span> <?= "RM " . $total; ?> </span>
        </div>

        <div class="payment-methods">
            <label><input type="radio" name="payment_method" value="bank" required> Bank</label><br>
            <label><input type="radio" name="payment_method" value="cod"> Cash On Delivery</label>
        </div>

        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Basic form validation
        document.querySelector('form').addEventListener('submit', function (event) {
            let fullName = document.getElementById('full_name').value.trim();
            let streetAddress = document.getElementById('street_address').value.trim();
            let townCity = document.getElementById('town_city').value.trim();
            let phoneNumber = document.getElementById('phone_number').value.trim();
            let email = document.getElementById('email').value.trim();

            if (!fullName || !streetAddress || !townCity || !phoneNumber || !email) {
                alert('Please fill out all required fields.');
                event.preventDefault(); // Prevent form submission
            }
        });
    });         
</script>

</body>
</html>
