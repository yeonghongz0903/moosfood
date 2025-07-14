<?php 
    function db_connect() {
        static $conn;

        $server_name = "localhost";
        $username = "root";
        $password = "";
        $db_name = "system";

        $conn = new mysqli($server_name, $username, $password, $db_name);
        if ($conn->connect_error) {
            die("Error connecting to database.");
        }

        return $conn;
    }


    function db_fetch_product($product_id) {
        $conn = db_connect();
        $id = htmlspecialchars($product_id);

        if (!is_numeric($id)) {
            return null;
        }

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = (?);");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        $res = mysqli_fetch_assoc($result);
        $result->close();

        return $res;

    }

    function db_select_query($query) {
        $conn = db_connect();

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $result->close();

        return $res;
    }

    function db_update_query($query, $var_type, $params = []) {
        $conn = db_connect();

        $stmt = $conn->prepare($query);
        $stmt->bind_param($var_type, ...$params);

        $stmt->execute();
        $stmt->close();
        
        $conn->close();
    }
?>