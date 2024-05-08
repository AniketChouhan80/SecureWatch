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




$sql = "SELECT page_text FROM pages WHERE page_name='aboutus'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$sql = "SELECT * FROM category";

$result_category = $conn->query($sql);

?>


<!DOCTYPE html>
<!--#a244d3-->
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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

        .about-banner {
            background-image: url(images/About-Us.png);
            /* height: 400px; */
            background-position: top;
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

        footer ul{
            display: flex;
            flex-direction: column;
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

        .content-area .col-3 {
            padding-right: 12px;
        }

        .category-banner h1 {
            color: black;
        }

        .sidebar ul li a {
            display: block;
            color: #666666;
            font-size: 20px;
            line-height: 16px;
            font-weight: 600;
            font-family: 'Barlow Condensed', sans-serif;
            padding: 24px 42px 22px;
            background-color: #f5f5f5;
            position: relative;
        }

        .sidebar ul li {
            display: block;
            margin-bottom: 10px;
            position: relative;
            padding: 0;
            border-bottom: 0;
        }

        .active-sidebar {
            background-color: #fa8100 !important;
            color: #fff;
        }

        .content-area {
            min-height: calc(100vh - 100px);
            padding-left: 12px;
            padding-right: 12px;
        }

        .main-area {
            padding-left: 32px;
        }


        .col1 {
            margin: 20px;

        }

        .col2 {
            margin: 20px;
        }


        input {
            height: 45px;
            width: 300px;
            border: 1px solid grey;
            box-shadow: 2px 2px 3px rgb(0, 0, 0, 0.9);
            color: grey;
            margin-left: 40px;
        }

        .col3 {
            margin: 20px;
        }

        form {
            width: 800px;
            margin: 0 auto;
        }

        textarea {
            width: 653px;
            margin-left: 44px;
            height: 100px;
            border: 1px solid grey;
            box-shadow: 2px 2px 3px rgb(0, 0, 0, 0.9);
            color: grey;
        }

        .poppins-thin {
            font-family: "Poppins", sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .poppins-extralight {
            font-family: "Poppins", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .poppins-light {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .poppins-regular {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-medium {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .poppins-semibold {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .poppins-bold {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .poppins-extrabold {
            font-family: "Poppins", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .poppins-black {
            font-family: "Poppins", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .poppins-thin-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .poppins-extralight-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .poppins-light-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .poppins-regular-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .poppins-medium-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .poppins-semibold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .poppins-bold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .poppins-extrabold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .poppins-black-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 900;
            font-style: italic;
        }

        .outer-nav {
            display: flex;
            align-items: center;
            justify-content: center;
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
            display: none;
            /* Initially hidden */
            z-index: 9999;
            /* Ensure it's above other content */
        }

        @media only screen and (max-width: 800px) {
            .about-banner {
                background-image: url(images/mobileAboutUs.png);
                position: relative;
            }

            .about-banner:before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.11);
                /* Adjust the alpha value to change opacity */
            }

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
            <section style="background:#fa8100;    padding-left: 12px;
            ">
                <div class="row top-bar" style="padding-left:12px;">
                    <div style="width:70%;">
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
                    <li class="cat"><a href="categories.php">Categories</a>
                        <ul class="inner-nav">

                            <?php while ($row_cat=$result_category->fetch_assoc()) { ?>
                            <li><a href="detail.php?category_id=<?php echo $row_cat['id']; ?>">
                                    <?php echo $row_cat['category_name']; ?>
                                </a></li>
                            <?php } ?>

                        </ul>
                    </li>
                    <li class="active"><a href="aboutus.php">About us</a></li>
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
        <div class="about-banner">
            <div class="searchContainer">
                <form action="" method="POST" class="searchBar">
                    <input type="search" value="<?php echo (isset($_POST['search'])?$_POST['search']:"");?>"
                        name="search" class="searchInput" placeholder="Search Products">
                    <button type="submit" class="searchButton">
                        <img src="icons/search.svg" alt="search">
                    </button>
                </form>
            </div>
        </div>
        <div class="main-text">
            <h1>Want to know About us? <br /> <strong>Read</strong>

            </h1>


        </div>


    </section>
    <div class="content-area" style="padding: 20px;">
        <div class="content-area" style="padding: 20px;">
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
        
                <div class="content-area" style="padding: 20px;">
                    <div class="row" style="display: flex; justify-content: center; align-items: center;">
                
                        <div class="col main-area" style="max-width: 800px; text-align: center; padding: 40px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
                
                            <h2 style="font-size: 28px; margin-bottom: 30px;">About Us</h2>
                
                            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;"><?php echo $row['page_text']; ?></p>
                
                            <div style="margin-bottom: 30px;">
                                <h3 style="font-size: 24px; color: #fa8100;">What Our Customers Say</h3>
                                <div class="testimonial" style="margin-top: 20px;">
                                    <blockquote style="font-style: italic; font-size: 16px; color: #666; margin-bottom: 10px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec magna eget justo congue eleifend. Nullam id leo eget libero porttitor placerat. Sed non nunc diam."</blockquote>
                                    <p style="font-weight: bold; font-size: 16px; margin-bottom: 5px;">John Doe</p>
                                    <p style="font-size: 14px; color: #888;">CEO, Company Name</p>
                                </div>
                            </div>
                
                            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;">Want to learn more about what we do? Feel free to <a href="contactus.php" style="color: #fa8100; text-decoration: none;">contact us</a> for more information.</p>
                
                        </div>
                
                    </div>
                </div>
                
        
            </div>
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
        window.onscroll = function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.querySelector('.back-to-top').style.display = 'block';
            } else {
                document.querySelector('.back-to-top').style.display = 'none';
            }
        };
    </script>

</body>

</html>