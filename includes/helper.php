<?php 
    session_start();
    require_once("db.php");

    function require_login() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: http://localhost/moosfood/webpages/login.php");
            exit();
        }
    }

    function get_user_id($email) {
        $email = htmlspecialchars($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $query = "SELECT user_id FROM users WHERE email = '$email'";
        $id = db_select_query($query)[0]["user_id"];

        return $id;
    }

    function get_user_id_session() {
        return $_SESSION['user_id'] ?? null;
    }

    function logout() {
        session_destroy();
    }

    function calculate_cart_total($user_id) {
        $user_id = htmlspecialchars($user_id);

        $query = "SELECT SUM(products.price * cart.quantity) AS total_price FROM products JOIN cart ON products.product_id = cart.product_id WHERE cart.user_id = '$user_id';";
        $total_price = db_select_query($query);

        return $total_price[0]["total_price"];
    }

    function validate_payment($user_id) {
        $user_id = htmlspecialchars($user_id);

        $total_price = calculate_cart_total($user_id);
        $query = "SELECT balance FROM users WHERE user_id = '$user_id'";
        $balance = db_select_query($query);
        $balance = $balance[0]["balance"];

        return $balance >= $total_price;
    }

    function get_products_from_cart($user_id) {
        $user_id = htmlspecialchars($user_id);

        $query = "SELECT * FROM products JOIN cart ON products.product_id = cart.product_id WHERE cart.user_id = '$user_id';";
        $products = db_select_query($query);
        $result = [];

        foreach($products as $product) {
            
            $res = [
                "product_id" => $product["product_id"],
                "product_name" => $product["product_name"],
                "price" => $product["price"],
                "stock_quantity" => $product["stock_quantity"],
                "description" => $product["description"],
                "image_path" => $product["image_path"]
            ];
            
            array_push($result, $res);
        }

        return $result;
    }

    function purchase_product($user_id) {
        $user_id = htmlspecialchars($user_id);

        if (validate_payment($user_id)) {

            $conn = db_connect();

            $query = "INSERT INTO orders (user_id) VALUES (?);";
            $var_type = "i";
            $params = array(htmlspecialchars($user_id));

            $stmt = $conn->prepare($query);
            $stmt->bind_param($var_type, ...$params);
            $stmt->execute();
            $stmt->close();

            $order_id = $conn->insert_id;
            $conn->close();

            $products = get_products_from_cart($user_id);
            foreach ($products as $product) {
                $product_id = $product["product_id"];

                $query = "SELECT quantity FROM cart JOIN products ON products.product_id = cart.product_id WHERE cart.product_id = '$product_id' AND cart.user_id = '$user_id';";
                $total_quantity = db_select_query($query);
                $total_quantity = $total_quantity[0]["quantity"];

                $query = "SELECT price FROM products WHERE product_id = '$product_id';";
                $total_price = db_select_query($query);
                $total_price = $total_price[0]["price"] * $total_quantity;
                
                $query = "INSERT INTO order_items (order_id, product_id, total_quantity, total_price) VALUES (?, ?, ?, ?);";
                $var_type = "iiid";
                $params = array($order_id, $product_id, $total_quantity, $total_price);
                db_update_query($query, $var_type, $params);

                $query = "SELECT stock_quantity FROM products WHERE product_id = '$product_id'";
                $stock = db_select_query($query);
                $stock = $stock[0]['stock_quantity'];
                $stock = $stock - $total_quantity;

                $query = "UPDATE products SET stock_quantity = ? WHERE product_id = ?";
                $var_type = "ii";
                $params = array($stock, $product_id);
                db_update_query($query, $var_type, $params);
            }
        }
    }

    function get_balance($user_id) {
        $user_id = htmlspecialchars($user_id);
        $query = "SELECT balance FROM users WHERE user_id = '$user_id';";

        $balance = db_select_query($query);

        return $balance[0]["balance"];
    }

    function clear_cart($user_id) {
        $query = "DELETE FROM cart WHERE user_id = (?);";
        $var_type = "s";
        $params = array(htmlspecialchars($user_id));

        db_update_query($query, $var_type, $params);
    }

    function process_payment($user_id) {
        $user_id = htmlspecialchars($user_id);

        if (!validate_payment($user_id)) {
            return;
        }
        
        $user_id = htmlspecialchars($user_id);
        $cost = calculate_cart_total($user_id);

        $balance = get_balance($user_id);

        $remaining_balance = $balance - $cost;

        $query = "UPDATE users SET balance = (?) WHERE user_id = (?);";
        $var_type = "di";
        $params = array($remaining_balance, $user_id);

        db_update_query($query, $var_type, $params);
    
        $query = "INSERT INTO payment (user_id, amount, payment_status, payment_method) VALUES (?, ?, ?, ?);";
        $var_type = "idss";
        // TODO: Change status and method
        $params = array($user_id, $cost, "completed", "credit_card");

        db_update_query($query, $var_type, $params);

    }

    function add_product($product, $values) {
        $query = "INSERT INTO products(product_name, price, stock_quantity, description, image_path) VALUES (?, ?, ?, ?, ?);";
        $var_type = "sdiss";
        $params = array($values["product_name"], $values["price"], $values["stock_quantity"], $values["description"], $values["image_path"]);

        db_update_query($query, $var_type, $params);
    }

    function update_product($product_id, $values) {
        $query = "UPDATE products SET product_name = (?), price = (?), stock_quantity = (?), description = (?), image_path = (?) WHERE product_id = '$product_id';";
        $var_type = "sdiss";
        $params = array($values["product_name"], $values["price"], $values["stock_quantity"], $values["description"], $values["image_path"]);

        db_update_query($query, $var_type, $params);
    }

    function is_email_empty($email) {
        $email = htmlspecialchars($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $query = "SELECT email FROM users WHERE email = '$email';";
        $result = db_select_query($query);
        
        return empty($result);
    }

    function update_user($user_id, $type, $content) {
        $user_id = htmlspecialchars($user_id);
        $type = htmlspecialchars($type);
        $content = htmlspecialchars($content);

        if ($type == "email") {
            $query = "SELECT email FROM users WHERE email = '$content';";
            $result = db_select_query($query);

            if (!isset($result)) {
                $query = "UPDATE users SET email = (?) WHERE user_id = (?);";
                $var_type = "si";
                $params = array($content, $user_id);
                db_update_query($query, $var_type, $params);

                return true;
            }

            return false;
        }

        else if ($type == "username") {
            $query = "UPDATE users SET username = (?) WHERE user_id = (?);";
            $var_type = "si";
            $params = array($content, $user_id);
            db_update_query($query, $var_type, $params);

            return true;
        }

        else if ($type == "password") {
            $query = "UPDATE users SET hash = (?) WHERE user_id = (?);";
            $var_type = "si";
            $params = array($content, $user_id);
            db_update_query($query, $var_type, $params);

            return true;
        }
        
        else {
            return false;
        }
    }

    function is_user_admin($user_id) {
        $user_id = htmlspecialchars($user_id);

        $query = "SELECT is_admin FROM users WHERE user_id = '$user_id';";
        $result = db_select_query($query)[0]["is_admin"];

        return $result == 1;
    }

    function add_product_to_cart($user_id, $product_id, $quantity) {

        $query = "INSERT INTO cart (product_id, quantity) VALUES (?, ?) WHERE user_id = (?);";
        $var_type = "iii";
        $params = array($product_id, $quantity, $user_id);
        db_update_query($query, $var_type, $params);
    }    
?>