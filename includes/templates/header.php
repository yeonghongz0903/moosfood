<head>
<title>MoosFood</title>
<link rel="website icon " type="png" href="http://localhost/moosfood/images_resources/mossfood_logo.jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>
    <link rel="stylesheet" href="http://localhost/moosfood/styles/header.css">
    <link rel="stylesheet" href="http://localhost/moosfood/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
<nav id="Navigation">

    <div class="nav-left">
        <img src="http://localhost/moosfood/images_resources/mossfood_logo.jpeg" width="55" height="55" alt="Food logo">
        <ul class="left-menu">
            <h1><li><a class="active" href="http://localhost/moosfood/index.php">Home</a></li> </h1>
            <h1><li><a href="http://localhost/moosfood/webpages/contact.php">Contact</a></li> </h1>
                <div class="dropdown">
                    <h1><button class="dropbtn" aria-haspopup="true" aria-expanded="false">Product</button></h1>
                    <div class="dropdown-content">
                        <form action="http://localhost/moosfood/index.php" method="post">
                            <input type="hidden" name="food">
                            <input type="submit" value="Foods" class="btn">
                        </form>
                        <form action="http://localhost/moosfood/index.php" method="post">
                            <input type="hidden" name="drink">
                            <input type="submit" value="Drinks" class="btn">
                        </form>
                    </div>
                </div>
            <h1><li><a href="http://localhost/moosfood/webpages/orderhistory.php">Order History</a></li></h1>
        </ul>
    </div>
    <div class="nav-right">
        <ul class="right-menu">
            
            <li>
                <form action="http://localhost/moosfood/index.php" method="post" class="search-container">
    <input type="text" placeholder="What are you looking for?" id="headerSearch" name="search_result">
    <button id="searchButton" type="submit" aria-label="Search">
        <img src="http://localhost/moosfood/images_resources/search.png" width="15" height="15" alt="Search">
    </button>
</form>

            </li>
            <li>
                <a href="http://localhost/moosfood/webpages/cart.php">
                    <img src="http://localhost/moosfood/images_resources/shopping-cart.png" width="20" height="20" alt="Cart">
                </a>
            </li>
        </ul>
        <img src="http://localhost/moosfood/images_resources/user.png" width="30" height="30" class="user" onclick="toggleMenu()" alt="User profile">
        <div class="drop" id="subMenu">
            <div class="list">
                <div class="info">
                    <h2>Your Profile</h2>
                    <hr>
                    <a href="http://localhost/moosfood/webpages/profile.php" class="link"><p>Profile</p></a>
                    <a href="http://localhost/moosfood/webpages/help.php" class="link"><p>Help</p></a>
                    <a href="http://localhost/moosfood/webpages/about.php" class="link"><p>About</p></a>
                    <a href="http://localhost/moosfood/webpages/logout.php" class="link"><p>Log out</p></a>
                </div>
            </div>
        </div>
    </div>

</nav>

<script>
   function toggleMenu() {
       const subMenu = document.getElementById("subMenu");
       subMenu.classList.toggle("open-menu");
   }
</script>

</body>
</html>