<?php
include 'track_visit.php';  // This will track the visit count
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Xpress</title>
    <link rel="stylesheet" href="burgerxpress.css">
</head>


<body>
    <header>
        <div class="header-content">
            <img src="assets/Images/burgerxpress-logo.jpeg" alt="Burgerxpress Logo" class="logo">
            <div class="header-text">
                <h1>BURGER XPRESS</h1>
                <div class="ratings">
                    <span>★★★★☆</span>
                    <a href="#reviews">See Reviews</a>
                    <a href="#more-info">More Info</a>
                </div>
            </div>
        </div>
    </header>


    <div class="section0">
        <div class="h1">
            <span>Available Deals</span>
            <span class="text"><a href="see-all">See all</a></span>
        </div>
        <div class="box">
            <a class="box1">
                <!-- <div class="img">
                   <img src="assets/Images/desktop_landing_EndltB.png.webp" alt="KFC-Dhanmondi">
               </div>-->
                <div class="text">
                    <h2>25% off (COMEBACK)</h2>
                    25% off with code comeback.<br>
                    Min. order tk 299. Discount capped at 75tk<br>
                    Valid for all items
                    <h4>Valid from 03 June to 30 June,2024</h4>
                </div>
            </a>
            <a class="box1">


                <div class="text">
                    <h2>100% off (COMEBACK)</h2>
                    100% off with code comeback.<br>
                    Min. order tk 499.<br>
                    Valid for all items
                    <h4>Valid from 03 June to 30 June,2024</h4>
                </div>
            </a>
            <a class="box1">


                <div class="text">
                    <h2>80tk off (Nagad)</h2>
                    80tk off with code Nagad80.<br>
                    Min. order tk 399.<br>
                    Valid for all items
                    <h4>Valid from 03 June to 30 June,2024</h4>
                </div>
            </a>
            <a class="box1">


                <div class="text">
                    <h2>50tk off (Bkash)</h2>
                    50tk off with code Bkash50.<br>
                    Min. order tk 299.<br>
                    Valid for all items
                    <h4>Valid from 03 June to 30 June,2024</h4>
                </div>
            </a>
        </div>
    </div>
    <section id="menu">
        <h3>Menu</h3>
        <nav>
            <ul>
                <li><a href="#popular">Popular</a></li>
                <li><a href="#chickenburgers">Chicken Burgres</a></li>
                <li><a href="#nachos">Nachos</a></li>
                <li><a href="#ricebowl">Rice Bowl</a></li>
            </ul>
        </nav>
    </section>
    <section id="menu-details">
        <div id="popular" class="menu-section">
            <h3>Popular</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-sausage-burg.jpg">
                        </div>
                        <div class="text">Chicken Sausage Delight;
                            price: 210tk
                        </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-chowminn.jpeg">
                        </div>
                        <div class="text">Chicken Chowmin; Price:243tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-sandwich.jpg">
                        </div>
                        <div class="text">Smokey BBQ Sub Sandwich; Price: 228tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-double-beef.jpeg">
                        </div>
                        <div class="text">Double Decker Beef Burger; price: 349tk</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="chickenburgers" class="menu-section">
            <h3>Chicken Burgers</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-chicken-burg.jpg">
                        </div>
                        <div class="text">Chicken Burger; Price: 189tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpess-cheese-burg.png">
                        </div>
                        <div class="text">Chicken Cheese Burger; Price: 219tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-bacon-burg.jpg">
                        </div>
                        <div class="text">Chicken And Bacon Bite Burger; Price: 273tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-mashrom-burg.jpg">
                        </div>
                        <div class="text">Mashroom Chicken Burger; Price: 279tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="nachos" class="menu-section">
            <h3>Nachos</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxprexx-cheesy-nachos.jpg">
                        </div>
                        <div class="text">Cheesy Chicken Nachos; price: 196tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxprexx-chessy-beef-nachos.jpg">
                        </div>
                        <div class="text">Cheesy Beef Nachos; price:249tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-mexican.jpg">
                        </div>
                        <div class="text">Mexican Hot And Spicy Nachos; price: 259tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-mash-nachos.jpg">
                        </div>
                        <div class="text">BBQ Chicken And Mashroom Nachos; price: 279tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="ricebowl" class="menu-section">
            <h3>Rice Bowl</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-crispy-bowl.jpg">
                        </div>
                        <div class="text">Rice Bowl With Crispy Chicken; price: 232tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-bbq-bowl.jpg">
                        </div>
                        <div class="text">BBQ Rice Bowl; price: 208tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-sizzling-bowl.jpg">
                        </div>
                        <div class="text">Rice Bowl With Beef Sizzling; price: 313tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/burgerxpress-beef-chillei-bowl.jpg">
                        </div>
                        <div class="text">Rice Bowl With Beef Chilli Onion; price: 298tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="kfc.js"></script>
</body>


</html>