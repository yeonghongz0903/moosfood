<?php 
    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();
    
    $user_id = get_user_id_session(); // Change this value to test

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['remove'])) {
            $remove_id = htmlspecialchars($_POST['remove_product']);
            $query = "DELETE FROM cart WHERE user_id = (?) AND product_id = (?);";
            $var_type = "ii";
            $params = array($user_id, $remove_id);

            db_update_query($query, $var_type, $params);
        }

        else if (isset($_POST['add-cart'])) {
            $product_id = htmlspecialchars($_POST['product-id']);
            $quantity = htmlspecialchars($_POST['quantity']);
        
            $query = "INSERT INTO cart (product_id, user_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = VALUES(quantity);";
            $var_type = "iii";
            $params = array($product_id, $user_id, $quantity);
            db_update_query($query, $var_type, $params);
        }
    }

    $query = "SELECT * FROM products WHERE product_id IN (SELECT product_id FROM cart WHERE user_id = '$user_id');";
    $items = db_select_query($query);

    $items_quantity = array();
    foreach ($items as &$item) {
        $product_id = $item['product_id'];
        $query = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id';";
        $quantity = db_select_query($query);

        $item['quantity'] = $quantity[0]['quantity'];
        $item['total_price'] = $item['quantity'] * $item['price'];
    }

    $balance = get_balance($user_id);
    if (empty($items)) {
        echo "<h1> Your cart is empty. <h1>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="http://localhost/moosfood/styles/script.css">
</head>
<body>

    <!-- Products from Cart Section -->
    <div class="container mt-4">
        <div class="row">
            <?php foreach($items as &$item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <a href="details.php?product_id=<?php echo htmlspecialchars($item['product_id']); ?>">
                            <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="Picture of product" width="200" height="200">
                        </a>
                        <div class="card-body">
                            <h2><?= htmlspecialchars($item['product_name']); ?></h2>
                            <p><?= htmlspecialchars("Total Price: $" . $item['total_price']); ?></p>
                            <p><?= htmlspecialchars("Quantity: " . $item['quantity']); ?></p>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="remove_product"; value="<?php echo $item['product_id']; ?>">
                                <input name="remove" type="submit" value="Remove" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container">
        <a href="payment.php"><button class="btn btn-primary">Buy Now!</button></a>
    </div>

    <?php include("../includes/templates/footer.php"); ?>
</body>
</html>
