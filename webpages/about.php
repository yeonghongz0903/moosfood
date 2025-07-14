
<?php
    // Include header and navigation
    include("../includes/templates/header.php");
    include("../includes/helper.php");
    
    require_login();
    ?>

<link rel="stylesheet" href="../styles/about.css">
<div class="picture-section">
    <h2>Moosfood</h2>
    <img src="../images_resources/founder.jpg" alt="Muhammad" class="founder-image">
</div>

<h2 class="section-title">Founder</h2>
<div class="row">
    <div class="column">
        <div class="container">
            <h3><strong>Operations Plan</strong></h3>
            <ul>
                <li>Suppliers: Establish reliable sources for fresh chicken, pizza ingredients, burger patties, and rice.</li>
                <li>Kitchen Setup: Ensure the kitchen is well-organized to handle multiple types of orders efficiently, especially during peak time.</li>
                <li>Staffing: Hire and train staff to specialize in different sections.</li>
                <li>Quality Control: Implement strict quality control measures to ensure consistent food quality across all menu items.</li>
            </ul>
        </div>
    </div>

    <div class="column">
        <div class="container">
            <h3><strong>Growth Strategy</strong></h3>
            <ul>
                <li>Customer Feedback: Regularly collect and analyze customer feedback to refine the menu and improve service.</li>
                <li>Expansion: Once established well for a couple of months, consider expanding to new locations or introducing new menu items based on customer demand.</li>
                <li>Partnerships: Explore partnerships with local events or businesses for catering opportunities.</li>
            </ul>
        </div>
    </div>

    <div class="column">
        <div class="container">
            <h3><strong>Challenges & Mitigation</strong></h3>
            <ul>
                <li>Competition: Differentiate Moosfood by emphasizing the quality and taste of fried chicken, while also offering variety through additional menu items.</li>
                <li>Supply Chain: Ensure strong relationships with suppliers to avoid disruptions and maintain product quality.</li>
                <li>Market Saturation: Regularly innovate with menu items, promotions, and customer engagement to stay ahead in a competitive market.</li>
            </ul>
        </div>
    </div>
</div>

<?php include("../includes/templates/footer.php"); ?>
</body>
</html>
