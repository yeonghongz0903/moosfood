<?php 
    include("includes/templates/header.php");
    include("includes/helper.php");

    $user_id = get_user_id_session();
    $query = "SELECT * FROM products;";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        if (isset($_POST['order'])) {
            if (validate_payment($user_id)) {      
                process_payment($user_id);
                purchase_product($user_id);
                clear_cart($user_id);
            }
            
            $query = "SELECT * FROM products";
            $items = db_select_query($query);
        }

        if (isset($_POST['search_result'])) {
            $search_result = htmlspecialchars($_POST["search_result"]);
            $query = "SELECT * FROM products WHERE product_name LIKE '%$search_result%';";
            $items = db_select_query($query);
        }

        if (isset($_POST['food'])) {
            $query = "SELECT * FROM products WHERE category = 'food'";
            $items = db_select_query($query);
        }

        if (isset($_POST['drink'])) {
            $query = "SELECT * FROM products WHERE category = 'drink'";
            $items = db_select_query($query);
        }

    }
    
    else {
        $items = db_select_query($query);
    }
    
    if (empty($items)) {
        echo "<h1> No such product exists! </h1>";
    }
    
    if (isset($user_id)) {
        echo "Your balance is <strong> RM" . get_balance($user_id) . "</strong>";
    }
?>

    <div class="container mt-4">
        <div class="row">
            <?php foreach($items as $item): ?>
                <div class="col-md-4" id="product-<?php echo ($item["product_id"]); ?>">
                    <div class="card mb-4">
                        <a href="webpages/details.php?product_id=<?php echo htmlspecialchars($item["product_id"]); ?>"><img src="<?php echo($item["image_path"]); ?>" alt="Picture of product." width="200" height="200"></a>
                        <div class="card-body">
                            <h2> <?= htmlspecialchars($item['product_name']); ?> </h2>
                            <p> <?= htmlspecialchars("$" . $item["price"]) ?> </p>
                            <p> <?= htmlspecialchars("Description: " . $item["description"]) ?> </p>
                            <p> <?= htmlspecialchars("Stock: " . $item["stock_quantity"]) ?> </p>

                            <?php echo "<button class='btn btn-primary' onclick=\"showModal(`{$item['product_name']}`, `{$item['product_id']}`)\">
                            Add To Cart
                            </button>" ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<form action="webpages/cart.php" method="post">
    <div class="popup-form modal" tabindex="-1" role="dialog" id='popup-form'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-title" class="modal-title">Modal title</h5>
                </div>
                <div class="modal-body">
                    <label for="product_quantity">Quantity: </label>
                    <input type="number" name="quantity" id="product-quantity" value="1" min="0">
                    <input type="hidden" name="add-cart" value="1">
                    <input type="hidden" name="product-id" value="" id="product-id">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add To Cart" class="btn btn-primary">
                    <button onclick="closeModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <script>
        
        function showModal(productName, productID) {
            var modal = document.getElementById('popup-form');
            document.getElementById('modal-title').innerText = productName;
            document.getElementById('product-id').value = productID;

            if (modal) {
                modal.style.display = 'block';
                modal.focus();
            }
        }

        function closeModal() {
            var modal = document.getElementById('popup-form');
            modal.style.display = 'none';
        }

    </script>

<?php include("includes/templates/footer.php"); ?>


</html>