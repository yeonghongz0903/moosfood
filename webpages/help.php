<?php
    // Include header and navigation
    include("../includes/templates/header.php");
    include("../includes/helper.php");

    require_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - FastFood Delivery</title>
    <link rel="stylesheet" href="../styles/help.css">
</head>
<body>

    <section class="help-section">
        <h1>Help & Support</h1>
        
        <!-- FAQs Section -->
        <h2>Frequently Asked Questions</h2>
        <ul>
            <div class="faq-container">
                <div class="faq-item">
                    <h3>How do I place an order?</h3>
                    <ol><p>You can place an order by browsing our menu online and selecting the items you wish to purchase. Once selected, click on the "Checkout" button and follow the on-screen instructions to complete your order.</p></ol>
                </div>
                <div class="faq-item">
                    <h3>What are the delivery hours?</h3>
                    <ol><p>Our delivery service is available from 10 AM to 10 PM, Monday to Sunday.</p></ol>
                </div>
                <div class="faq-item">
                    <h3>What payment methods do you accept?</h3>
                    <ol><p>We accept cash on delivery, credit/debit cards, and mobile payment options such as Apple Pay and Google Pay.</p></ol>
                </div>
                <div class="faq-item">
                    <h3>Can I track my order?</h3>
                    <ol><p>Yes, once your order is placed, you will receive a tracking link via SMS or email to follow your order’s status in real time.</p></ol>
                </div>
            </div>

            <!-- How to Order Section -->
            <h2>How to Place an Order</h2>
            <ol class="order-steps">
                <li>Browse our menu and select the items you want.</li>
                <li>Click on the "Add to Cart" button for each item.</li>
                <li>Once you have selected all your items, click on the "Checkout" button.</li>
                <li>Enter your delivery address and select your preferred payment method.</li>
                <li>Confirm your order and wait for a confirmation message with your delivery details.</li>
            </ol>

            <!-- Contact Support Section -->
            <h2>Contact Support</h2>
            <p>If you need further assistance, feel free to reach out to us:</p>
            <ul class="contact-details">
                <li>Email: <a href="mailto:support@fastfood.com">support@fastfood.com</a></li>
                <li>Phone: 1000-555-999</li>
                <li>Live Chat: Available from 10 AM to 10 PM</li>
            </ul>
        </ul>
    </section>

<?php
// Include footer
include("../includes/templates/footer.php");
?>

</body>
</html>
