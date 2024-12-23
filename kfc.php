<?php
include 'track_visit.php';  // This will track the visit count
include('nav.php');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFC Restaurant</title>
    <link rel="stylesheet" href="kfc.css">
</head>


<body>
    <header>
        <div class="header-content">
            <img src="assets/Images/kfc-logo.png" alt="KFC Logo" class="logo">
            <div class="header-text">
                <h1>KFC Restaurant</h1>
                <div class="ratings">
                    <span>★★★★☆</span>
                    <a href="#reviews">See Reviews</a>
                    <a href="#more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="btn">
            <a href="reservation_form.php?title=KFC%20Restaurant">reserve a table</a>
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
                <li><a href="#rice">Rice</a></li>
                <li><a href="#chicken">Chicken</a></li>
                <li><a href="#burgers">Burgers</a></li>
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
                            <img src="assets/Images/kfc-chicken.avif">
                        </div>
                        <div class="text">2 pc Hot And Crispy Chicken;
                            price: 309tk
                        </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-burger.jpg">
                        </div>
                        <div class="text">Buddy Zinger Combo; Price:799tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-rice.jpg">
                        </div>
                        <div class="text">Rice Box; Price: 299tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-snacks.jpg">
                        </div>
                        <div class="text">3 pc Hot Wings; price: 169tk</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="rice" class="menu-section">
            <h3>Rice</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-rice.jpg">
                        </div>
                        <div class="text">Rice Box; Price: 299tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-rizo-rice.jpeg">
                        </div>
                        <div class="text">Rizo Rice Box; Price: 279tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-biriyani-bucket.webp">
                        </div>
                        <div class="text">Biriyani Bucket; Price: 250tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-chicken-rice.png">
                        </div>
                        <div class="text">Chicken Rice Box; Price: 450tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="chicken" class="menu-section">
            <h3>Chicken</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-4pc-chicken.jpg">
                        </div>
                        <div class="text">4 pc Hot Crispy Chicken; price: 599tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-boneles-chicken.jpg">
                        </div>
                        <div class="text">6pc Boneless Strips; price:499tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-smokey-chicken.png">
                        </div>
                        <div class="text">4pc Smokey Red Chicken; price: 599tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-hot-wings.jpg">
                        </div>
                        <div class="text">6pc Hot Wings; price: 309tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="burgers" class="menu-section">
            <h3>Burgers</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-zinger-burger.jpeg">
                        </div>
                        <div class="text">Double Zinger Burger; price: 449tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/KFC-Double-Down-Burger.jpg">
                        </div>
                        <div class="text">Double Down Burger; price: 399tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-zing-fries.jpeg">
                        </div>
                        <div class="text">Zing & Fries Meal; price: 399tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-zingerbox.jpeg">
                        </div>
                        <div class="text">Zinger Box; price: 499tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="kfc.js"></script>
</body>


</html>