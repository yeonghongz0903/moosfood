<?php 
    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = isset($_GET['product_id']) ? htmlspecialchars($_GET['product_id']) : null;
    }

    $result = $id ? db_fetch_product($id) : null;
?>

<link rel="stylesheet" href="../styles/details.css">
<div class="product-detail-container">

    <?php if ($result): ?>
        <!-- Breadcrumbs -->
        <div class="breadcrumb">
            <a href="/shop">Home</a> / <span>Product Detail</span>
        </div>

        <div class="product-detail">
            <!-- Product Image Thumbnails -->
            <div class="product-thumbnails">
                <img src="<?= htmlspecialchars($result["image_path"]) ?>" alt="Product Thumbnail 1" class="thumbnail-img">
            </div>

            <!-- Main Product Image -->
            <div class="product-main-image">
                <img src="<?= htmlspecialchars($result["image_path"]) ?>" alt="Main Product Image" id="main-product-img">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h2><?= htmlspecialchars($result["product_name"]); ?></h2>
                <p class="price"><?= htmlspecialchars("$" . $result["price"]); ?></p>
                <p class="description"><?= htmlspecialchars($result["description"]); ?></p>

                <!-- Quantity Selection -->
                <div class="product-quantity">
                    <h4>Quantity:</h4>
                    <input type="number" id="product-quantity" value="1" min="1" max="<?= htmlspecialchars($result["stock_quantity"]) ?>" class="quantity-input">
                </div>

                <!-- Add to Cart Form -->
                <form action="cart.php" method="post" id="add-to-cart-form">
                    <input type="hidden" name="add-cart" value="1">
                    <input type="hidden" name="product-id" id="product-id" value="<?= $id ?>">
                    <input type="hidden" name="quantity" id="cart-quantity">
                    
                    <button type="button" class="btn btn-primary" onclick="addToCart()">
                        Add To Cart
                    </button>
                </form>

                <!-- Delivery Info -->
                <div class="delivery-info">
                    <h4>Table Service</h4>
                    <p>Pls keep your order ID</p>
                </div>
            </div>
        </div>

    <?php else: ?>
        <h1>Product does not exist!</h1>
    <?php endif; ?>

</div>

<script>
    // Function to submit the Add to Cart form with the selected quantity
    function addToCart() {
        // Get the selected quantity from the input field
        var quantity = document.getElementById('product-quantity').value;

        // Set the quantity in the hidden form field
        document.getElementById('cart-quantity').value = quantity;

        // Submit the form
        document.getElementById('add-to-cart-form').submit();
    }
</script>

<?php include("../includes/templates/footer.php"); ?>

</html>
