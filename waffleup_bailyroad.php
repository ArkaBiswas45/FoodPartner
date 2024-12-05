<?php
include 'track_visit.php';  // This will track the visit count
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waffle Up</title>
    <link rel="stylesheet" href="waffleup_baily.css">
</head>
<body>
    <header>
        <div class="header-content">
            <img src="assets/Images/waffleup-logo.png" alt="KFC Logo" class="logo">
            <div class="header-text">
                <h1>Waffle Up</h1>
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
                <li><a href="#waffle-stick">Waffle on a Stick</a></li>
                <li><a href="#waffle-no-stick">Waffle without Stick</a></li>
                <li><a href="#Exclusive">Exclusive Treat for 4</a></li>
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
                            <img src="assets/Images/waffleup-baily-trichocolate.png">
                        </div>
                        <div class="text">Tri-Chocolate Waffle on a Stick;
                            price: 185tk
                        </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-madmango.png">
                        </div>
                        <div class="text">Mad Mango Waffle on a Stick; Price:215tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-deathbynutella.png">
                        </div>
                        <div class="text">Death By Nutella(One side Dipped in Nutella); Price: 175tk</div>
                    </a>
                    <!-- <a class="box11">
                        <div class="img">
                            <img src="assets/Images/kfc-snacks.jpg">
                        </div>
                        <div class="text">3 pc Hot Wings; price: 169tk</div>
                    </a> -->
                </div>
            </div>
        </div>
        <div id="waffle-stick" class="menu-section">
            <h3>Waffle on a Stick</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-red-velvet.png">
                        </div>
                        <div class="text">Red Velvet Waffle; Price: 165tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-nutella.png">
                        </div>
                        <div class="text">Nutella Waffle; Price: 160tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-trichocolate.png">
                        </div>
                        <div class="text">Tri-Chocolate Waffle; Price: 185tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-madmango.png">
                        </div>
                        <div class="text">Mad Mango Waffle; Price: 215tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="waffle-no-stick" class="menu-section">
            <h3>Waffle without Stick</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-deathbynutella.png">
                        </div>
                        <div class="text">Death By Nutella(One side Dipped in Nutella); Price: 175tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-banana&nuts.png">
                        </div>
                        <div class="text">Bananatella & Nuts; price:160tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-strawberry-banana.png">
                        </div>
                        <div class="text">Strawberry & Banana with Nutella; price: 175tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-fruitybliss.png">
                        </div>
                        <div class="text">Fruity Bliss with Ice Cream; price: 240tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-verystrawberry.png">
                        </div>
                        <div class="text">Very Very Strawberry; price: 190tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="Exclusive" class="menu-section">
            <h3>Exclusive Treat for 4</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-exclusive.png">
                        </div>
                        <div class="text">Waffle Madness
                            2 pcs Nutella,1 pc Tri-Chocolate,1 pc Mad Mango ; price: 648tk</div>
                    </a>
                    <!-- <a class="box11">
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
                    </a> -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="kfc.js"></script>
</body>


</html>