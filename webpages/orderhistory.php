<?php

    include("../includes/templates/header.php");
    include("../includes/helper.php");

    require_login();

    $user_id = get_user_id_session();

    $query = "SELECT * FROM order_items JOIN orders ON orders.order_id = order_items.order_id WHERE orders.order_id IN (SELECT order_id FROM orders WHERE user_id = '$user_id');";
    $order_history = db_select_query($query);
?>


<div class="order-history-container">
    <h1>Your Order History</h1>

    <?php if (!empty($order_history)): ?>
        <div class="container">
            <table class="order-history-table table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount (RM)</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_history as $order): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo date("F j, Y", strtotime($order['created_at'])); ?></td>
                            <td><?php echo number_format($order['total_price'], 2); ?></td>
                            <td><a href="details.php?product_id=<?php echo $order['product_id']; ?>" class="details-link">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="container">
            <p class="no-orders">You haven't placed any orders yet.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

<?php include("../includes/templates/footer.php"); ?>
