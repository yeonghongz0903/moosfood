    CREATE TABLE `users`(
        `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `hash` VARCHAR(255) NOT NULL,
        `balance` DECIMAL(8, 2) NOT NULL DEFAULT '100',
        `is_admin` BOOLEAN NOT NULL DEFAULT '0',
        `created_at` TIMESTAMP NOT NULL
    );

    CREATE TABLE `products`(
        `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `product_name` VARCHAR(255) NOT NULL,
        `price` DECIMAL(8, 2) NOT NULL,
        `category` VARCHAR(255) NOT NULL,
        `stock_quantity` INT NOT NULL,
        `description` VARCHAR(255) NOT NULL,
        `image_path` VARCHAR(255) NULL,
        `created_at` TIMESTAMP NOT NULL
    );

    CREATE TABLE `payment`(
        `payment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT UNSIGNED NOT NULL,
        `amount` DECIMAL(8, 2) NOT NULL,
        `payment_status` ENUM ('completed', 'canceled', 'pending') NOT NULL,
        `payment_method` ENUM ('credit_card', 'debit_card', 'tng') NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    );

    CREATE TABLE `orders`(
        `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT UNSIGNED NOT NULL,
        `created_at` TIMESTAMP NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    );

    CREATE TABLE `order_items`(
        `order_id` INT UNSIGNED NOT NULL,
        `product_id` INT UNSIGNED NOT NULL,
        `total_quantity` INT NOT NULL,
        `total_price` DECIMAL(8, 2) NOT NULL,
        PRIMARY KEY (order_id, product_id),
        FOREIGN KEY (order_id) REFERENCES orders(order_id),
        FOREIGN KEY (product_id) REFERENCES products(product_id)
    );


    CREATE TABLE `cart`(
        `product_id` INT UNSIGNED NOT NULL,
        `user_id` INT UNSIGNED NOT NULL,
        `quantity` INT NOT NULL,
        `created_at` TIMESTAMP NOT NULL,
        PRIMARY KEY (product_id, user_id),
        FOREIGN KEY (product_id) REFERENCES products(product_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    );