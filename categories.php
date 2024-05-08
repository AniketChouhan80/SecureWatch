<?php 

require("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the search term from the form
    $searchTerm = $_POST['search'];

    // Query the database to check if the product exists
    $query = "SELECT * FROM product WHERE product_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product exists, retrieve the product data
        $product = $result->fetch_assoc();
        $productId = $product['id'];
        $categoryId = $product['category_id']; // Retrieve category ID from the product data
        
        // Check if the product ID is between 1-9, then replace it with product ID from 10-18
        if ($productId >= 1 && $productId <= 9) {
            $productId = $productId + 9;
        }
        
        // Check if the category ID is 45, then redirect to category ID 34
        if ($categoryId == 45) {
            $redirectCategoryId = 34;
        } else {
            $redirectCategoryId = $categoryId;
        }
        
        // Redirect to detail.php with category_id and product_id parameters
        header("Location: detail.php?category_id=$redirectCategoryId&product_id=$productId");
        exit();
    } else {
        // Product doesn't exist, display a toast message using JavaScript
        echo "<script>alert('Product not found.');</script>";
    }
}




$sql = "SELECT * FROM category";

$result = $conn->query($sql);

$sql = "SELECT * FROM category";

$result_category = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=600, initial-scale=1.0">
    <!-- lets add two style files-->
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel='stylesheet' id='serity-google-fonts-css'
        href='//fonts.googleapis.com/css?family=Arimo%3A400%2C400i%2C700%2C700i%7CBarlow+Condensed%3A100%2C100i%2C200%2C200i%2C300%2C300i%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%2C800%2C800i%2C900%2C900i%7CMontserrat%3A100%2C100i%2C200%2C200i%2C300%2C300i%2C400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i%2C800%2C800i%2C900%2C900i&#038;display=swap&#038;ver=5.4.13'
        media='all' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        li {
            display: inline-block;


        }

        .top-bar>div {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        ul li a {
            font-family: "Barlow Condensed";
        }

        body {
            font-family: "Barlow Condensed";
        }

        .outer-nav>li {
            display: inline-block;
            font-size: 19px;
            margin-left: 21px;
            font-weight: 500;
            color: #333333;
            font-size: 18px;
            font-weight: 500;
            position: relative;
            cursor: pointer;
            transform: revert-layer;
            text-transform: uppercase;
        }

        .inner-nav {
            position: absolute;
            background: darkorange;
            padding: 12px;
            z-index: 32323;
            border-radius: 12px;
            width: 200px;
        }

        .inner-nav a {
            color: white
        }

        .inner-nav li {
            line-height: 35px;
            display: block;
        }

        i {
            color: white;
        }

        .category-banner {
            background-image: url(images/security-camera-cloud-2048px-1234-2x1-1.webp);
            /* height: 400px; */
            background-position: bottom;
            background-size: cover;

            position: relative;
            left: 0px;
            top: 0px;
            z-index: 900;
            /* padding-top: 235px; */
            height: 100%;
            /* padding: 323px 0 232px; */
            opacity: 1;
            background-repeat: no-repeat;
            background-size: cover;
            /* padding: 240px 0 253px; */
            position: relative;
            opacity: 0.6;
            height: calc(100vh - 200px);

        }

        .home-banner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: 0.7;
        }

        .main-text h1 {
            color: black;
            font-size: 52px;

        }

        .main-text {
            position: absolute;
            top: 30%;
            left: 10%;
            z-index: 11111;
        }

        .active {
            border-bottom: 3px solid #fa8100;
            padding-bottom: 5px;
            border-radius: 3px;
        }

        a {
            text-decoration: none;
        }

        .cat>a::after {
            content: "\f0d7";
            font-weight: 400;
            position: absolute;
            color: orange;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            margin-left: 4px;
        }

        .inner-nav {
            display: none;
        }

        .cat {
            padding-bottom: 6px;
            margin-right: 12px;
        }

        .cat:hover .inner-nav {
            display: block;
        }

        a {
            color: black;
        }

        .box-image {
            position: relative;
        }

        .overlay {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background-color: black;
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
            opacity: 0.7
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .box-image:hover .overlay {
            bottom: 0;
            height: 100%;
        }

        .content-area {
            margin-top: 30px;
        }

        .content-area h2 {
            margin: 0;
            padding-top: 12px;
            border-top-left-radius: 12px;
            padding-bottom: 12px;
            text-align: center;
            background: linear-gradient(45deg, #aaaa93, #eaa829);
            color: white;
            border-top-right-radius: 12px;
        }

        .content-area .row .col-3 {
            padding: 5px;
            box-sizing: border-box;
        }

        .category-banner h1 {
            color: black;
        }

        .outer-nav {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        footer ul{
            display: flex;
            flex-direction: column;
        }


        .outer-nav>li:not(.active):not(.cat):not(.search)>a:hover {
            text-decoration: none;
        }

        .outer-nav>li:not(.active):not(.cat):not(.search)>a::after {
            content: '';
            display: block;
            width: 0;
            height: 4px;
            /* Increased height */
            background-color: orange;
            /* Change to orange */
            transition: width 0.3s;
        }

        .outer-nav>li:not(.active):not(.cat):not(.search)>a:hover::after {
            width: 100%;
        }

        .outer-nav>li:not(.active):not(.cat):not(.search)>a:hover,
        .inner-nav>li>a:hover {
            text-decoration: none;
        }

        .outer-nav>li:not(.active):not(.cat):not(.search)>a::after,
        .inner-nav>li>a::after {
            content: '';
            display: block;
            width: 0;
            height: 4px;
            /* Increased height */
            background-color: orange;
            /* Change to orange */
            transition: width 0.3s;
        }

        .outer-nav>li:not(.active):not(.cat):not(.search)>a:hover::after,
        .inner-nav>li>a:hover::after {
            width: 100%;
        }

        .inner-nav>li>a::after {
            background-color: black;
            /* Underline color for inner-nav */
        }

        .search {
            display: flex;
            align-items: center;
        }

        .outer-nav {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .searchContainer {
        position: relative;
        display: none;
        justify-content: center;
        width: 90%; 
        max-width: 400px;
        margin: 0 auto;
        height: 50px; 
    }

    .searchBar {
        display: flex;
        flex: 1;
        background-color: #fff;
        border-radius: 25px;
        overflow: hidden;
    }

    .searchInput {
        flex: 1;
        border: none;
        padding: 10px;
        font-size: 16px;
        outline: none;
        background: transparent;
    }

    .searchButton {
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
        padding: 10px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .searchButton img {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    .searchButton:hover {
        background-color: #0056b3;
    }

    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 20px;
        cursor: pointer;
        display: none; /* Initially hidden */
        z-index: 9999; /* Ensure it's above other content */
    }

    @media only screen and (max-width: 800px) {
            .back-to-top {
            width: 40px;
            height: 40px;
            font-size: 16px;
            bottom: 10px;
            right: 10px;
        }
        }


    </style>
</head>

<body>

    <div>
        <header>
            <section style="background:#fa8100;
            ">
                <div class="row top-bar">
                    <div style="padding-left: 25px;">
                        <span style="color:white;font-weight:medium;font-size:19px;">
                            <i class="fa fa-envelope-o"></i>&nbsp;chouhananiket24@gmail.com
                        </span>&nbsp;&nbsp;&nbsp;
                        <span style="color:white;font-weight:medium;font-size:19px;">
                            <i class="fa fa-map-marker"></i>&nbsp;SAHARANPUR (U.P)
                        </span>
                    </div>

                </div>
    </div>

    </section>
    <div class="row nav"
        style="padding-left:12px;padding-top:12px;padding-right:12px;padding-bottom:20px;border-bottom:2px solid gray; display:flex; justify-content: space-between; align-items:center;">
        <div class="hamburger">
            <img src="icons/menu.svg" alt="menu">
        </div>
        <div class="logo">
            <a href="index.php"><img src="images/mainlogo.png" style="max-width:100px;min-width:0;"></a>
        </div>
        <div class="navParent">
            <nav>
                <ul class="outer-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active cat"><a href="#">Categories</a>
                        <ul class="inner-nav">

                            <?php while ($row=$result_category->fetch_assoc()) { ?>
                            <li><a href="detail.php?category_id=<?php echo $row['id']; ?>">
                                    <?php echo $row['category_name']; ?>
                                </a></li>
                            <?php } ?>


                        </ul>
                    </li>
                    <li><a href="aboutus.php">About us</a></li>
                    <li><a href="contactus.php">Contact us</a></li>
                    <li>
                        <div class="search"><lord-icon src="https://cdn.lordicon.com/fkdzyfle.json" trigger="hover"
                                style="width:25px;height:25px"></div>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="right">
            <a href="contactus.php" style="    padding-right: 32px;
                        padding-top: 12px;
                        padding-bottom: 12px;
                        padding-left: 32px;
                        background: black;
                        color: white;
                        display: inline-block;
                        border-radius: 8px;
                        text-decoration: none;
                        background: #fa8100;">Get a quote</a>
        </div>


    </div>
    </header>
    <section>
        <div class="category-banner">
            <div class="searchContainer">
                <form action="" method="POST" class="searchBar">
                    <input type="search" value="<?php echo (isset($_POST['search'])?$_POST['search']:"");?>" name="search" class="searchInput" placeholder="Search Products">
                    <button type="submit" class="searchButton">
                        <img src="icons/search.svg" alt="search">
                    </button>
                </form>
            </div>
        </div>
        <div class="main-text">
            <h1>Find your product in one of our <br /> 100+ <strong>Categories</strong>

            </h1>


        </div>


    </section>
    
    <div class="content-area" style="border-top:2px solid black">
        <div class="row" style="flex-wrap:wrap;">

            <?php while($row=$result->fetch_assoc()) {  ?>
            <div class="col-3" style="margin-top: 50px">
                <h2>
                    <?php echo $row['category_name']; ?>
                </h2>
                <div class="box-image" style="height:450px">
                    <img src="uploads/<?php echo $row['category_image']; ?>" />
                    <div class="overlay">
                        <div class="text">
                            <?php echo $row['category_descp']; ?>
                            <a style="color:white; background-color: #fa8100; background-size: 30px; text-decoration:underline; padding: 12px 22px "
                                href="detail.php?category_id=<?php echo $row['id']; ?>">View Products</a>
                        </div>

                    </div>
                </div>

            </div>
            <?php } ?>
        </div>
    </div>

    <footer style="border-top: 1px solid grey; margin-top: 12px; padding: 20px; background-color: #eae8e8;">
        <div class="row">
            <div class="col-4 center" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: #333;">
                <h2><img style="border-radius: 5%;" src="images/mainlogo.png" style="max-width: 200px; min-width: 0;"></h2>
                <p style="color: #333; line-height: 1.6;">
                    Security as a topic has continued to rise in popularity in the recent couple of years, and it comes as no surprise. Security and privacy are two sides of the same coin. You can't have privacy without security and vice versa.
                </p>
            </div>
            <div class="col-4 center footer-contact" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: #333;">
                <h2 style="margin-bottom: 50px; margin-top: 20px; font-size: 24px; color: #ff9900;">Our Contacts</h2>
                <ul class="our Contact" style="line-height: 40px; text-align: left; list-style: none;">
                    <li>
                        <i class="fa fa-map-marker" style="color: #ff9900;"></i>
                        <span class="serity-contact-heading" style="margin-left: 10px;">Address</span>
                        <span style="color: #333;">Melbourne Main Street VIC 3000, Australia</span>
                    </li>
                    <li>
                        <i class="fa fa-envelope" style="color: #ff9900;"></i>
                        <span class="serity-contact-heading" style="margin-left: 10px;">Email</span>
                        <a href="mailto: support@example.com" style="color: #333;"> support@example.com</a>
                    </li>
                    <li>
                        <i class="fa fa-mobile" style="color: #ff9900;"></i>
                        <span class="serity-contact-heading" style="margin-left: 10px;">Phone</span>
                        <span style="color: #333;">
                            <a href="tel:+920023456789" style="color: #333;">+9200 (2) 345 6789</a>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-4 center" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: #333;">
                <h2 style="margin-bottom: 50px; margin-top: 20px; font-size: 24px; color: #ff9900;">Our Social Media</h2>
                <ul style="line-height: 40px; list-style: none; text-align: justify;">
                    <li><a href="#" style="text-decoration: none; color: #333;"><i class="fa fa-facebook" style="color: #ff9900;"></i>Facebook</a></li>
                    <li><a href="#" style="text-decoration: none; color: #333;"><i class="fa fa-twitter" style="color: #ff9900;"></i>Twitter</a></li>
                    <li><a href="#" style="text-decoration: none; color: #333;"><i class="fa fa-whatsapp" style="color: #ff9900;"></i>Whatsapp</a></li>
                </ul>
            </div>
        </div>
    </footer>
    
    </div>
    <button class="back-to-top" onclick="backToTop()">
        <i class="fa fa-arrow-up"></i> <!-- Font Awesome "arrow-up" icon -->
    </button>
    <script src="js/script.js"></script>

    <script>
        // Function to scroll the page to the top
        function backToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' }); // Smooth scroll to top
        }

        // Show the "Back to Top" button when user scrolls down
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.querySelector('.back-to-top').style.display = 'block';
            } else {
                document.querySelector('.back-to-top').style.display = 'none';
            }
        };
    </script>

</body>

</html>