-- Make sure to disable foreign key checks before running this script

TRUNCATE TABLE orders;
TRUNCATE TABLE order_items;
TRUNCATE TABLE payment;
TRUNCATE TABLE products;
TRUNCATE TABLE users;

INSERT INTO products(product_name, price, category, stock_quantity, description, image_path) VALUES 
("Fried Chicken", 10.99, "food", 100, "Crispy on the outside, tender and juicy on the inside. This golden fried chicken will have you coming back for more", "http://localhost/moosfood/images_resources/food/friedchicken.jpg"),
("Pizza", 17.99, "food", 135, "A cheesy, mouthwatering slice of heaven. Our pizza is topped with fresh ingredients and baked to perfection", "http://localhost/moosfood/images_resources/food/pizza.jpg"),
("Peperoni Pizza", 7.99, "food", 70, "A classic favorite with a generous helping of spicy pepperoni and melted cheese. A flavor explosion in every bite", "http://localhost/moosfood/images_resources/food/peperonipizza.jpg"),
("BBQ Fried Chicken", 7.99, "food", 70, "Savor the smoky sweetness of barbecue glaze on crispy fried chicken. This bold and tangy combination is pure comfort food.", "http://localhost/moosfood/images_resources/food/bbqfriedchicken.png"),
("Spicy Fried Chicken", 7.99, "food", 70, "Turn up the heat with our spicy fried chicken! Crispy, fiery, and deliciously seasoned for those who like it hot.", "http://localhost/moosfood/images_resources/food/spicyfriedchicken.jpg"),
("Hawaiian Pizza", 16.00, "food", 70, "A tropical twist on the classic pizza. Sweet pineapple and savory ham meet to create a refreshing burst of flavor.", "http://localhost/moosfood/images_resources/food/hawaiianpizza.jpg"),
("Cheeseburger", 14.99, "food", 24, "Juicy beef patty topped with melted cheese, fresh lettuce, and tomato, all packed in a soft bun. A burger that delivers big on flavor", "http://localhost/moosfood/images_resources/food/cheeseburger.jpg"),
("Steak", 25.00, "food", 115, "Grilled to perfection, our succulent steak is tender and bursting with savory flavors. A true feast for meat lovers.", "http://localhost/moosfood/images_resources/food/steak.jpg"),
("Roti Canai", 25.00, "food", 115, "Grilled to perfection, our succulent steak is tender and bursting with savory flavors. A true feast for meat lovers.", "http://localhost/moosfood/images_resources/food/roticanai.png"),
("Roti Tissue", 25.00, "food", 115, "Grilled to perfection, our succulent steak is tender and bursting with savory flavors. A true feast for meat lovers.", "http://localhost/moosfood/images_resources/food/rotitissue.jpeg"),
("Fries", 7.00, "food", 56, "Golden, crispy fries seasoned to perfection. The perfect sidekick to any meal, or enjoy them all on their own.", "http://localhost/moosfood/images_resources/food/fries.jpeg"),
("Fried Rice", 11.99, "food", 100, "A savory mix of rice, vegetables, and spices stir-fried to perfection. A comforting dish packed with flavor", "http://localhost/moosfood/images_resources/food/FriedRice.png"),
("Jai Yen", 11.50, "drink", 40, "Cool and refreshing, Jai Yen is a traditional Thai iced drink with a perfect balance of sweetness and tea, offering a delightful twist to your everyday tea experience.", "http://localhost/moosfood/images_resources/drink/jaiyen.jpeg"),
("Fruit Juice", 7.99, "drink", 70, "Freshly squeezed and packed with vitamins, our fruit juice is a perfect blend of sweetness and refreshment.", "http://localhost/moosfood/images_resources/drink/juice.jpg"),
("Watermelon Juice", 7.99, "drink", 70, "Juicy, refreshing slices of watermelon, bursting with natural sweetness. Perfect for cooling down on a hot day.", "http://localhost/moosfood/images_resources/drink/watermelon.jpg"),
("Apple Juice", 7.99, "drink", 70, "Crisp and sweet, our fresh apples are the perfect healthy snack to brighten your day.", "http://localhost/moosfood/images_resources/drink/apple.jpg"),
("Milo", 4.50, "drink", 70, "A chocolatey, malt beverage that's both comforting and energizing. Perfect for starting your day or enjoying a cozy evening.", "http://localhost/moosfood/images_resources/drink/milo.png"),
("Coffee", 4.50, "drink", 70, "Bold, rich, and aromatic. Our coffee is the perfect pick-me-up, brewed to awaken your senses and keep you going.", "http://localhost/moosfood/images_resources/drink/coffee.jpeg"),
("Ice Lemon Tea", 4.00, "drink", 70, "A refreshing blend of tangy lemon and chilled tea. Crisp, cool, and the perfect thirst quencher on a hot day", "http://localhost/moosfood/images_resources/drink/icelemontea.jpeg"),
("Tea", 2.50, "drink", 70, "A soothing and aromatic brew made from the finest tea leaves. Whether enjoyed hot or cold, it's a timeless beverage perfect for any occasion", "http://localhost/moosfood/images_resources/drink/tea.jpeg"),
("CoffeeO", 4.50, "drink", 70, "Bold, rich, and aromatic. Our coffee is the perfect pick-me-up, brewed to awaken your senses and keep you going.", "http://localhost/moosfood/images_resources/drink/coffeeO.jpg");
