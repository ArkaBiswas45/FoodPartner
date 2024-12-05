<?php
include 'track_visit.php';  // This will track the visit count
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheez-Baily</title>
    <link rel="stylesheet" href="cheez_baily.css">
</head>


<body>
    <header>
        <div class="header-content">
            <img src="assets/Images/cheez-logo.png" alt="KFC Logo" class="logo">
            <div class="header-text">
                <h1>Cheez</h1>
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
                <li><a href="#classic-pizza">Classic Pizza</a></li>
                <li><a href="#pasta">Pasta</a></li>
                <li><a href="#G-pizza">Gourmet Pizza</a></li>
                <li><a href="#cheez-boat">Cheezy Boats</a></li>
                <li><a href="#cheez-chow">Cheezy Chowderz</a></li>
                <li><a href="#dessert">Dessert</a></li>
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
                            <img src="assets/Images/cheez-pizza-spicysausage.png">
                        </div>
                        <div class="text">Spicy Sausage; price: 475tk
                        </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-creamy chicken sausage.png">
                        </div>
                        <div class="text">Creamy Chicken & Sausage; Price:618tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-creamy.png">
                        </div>
                        <div class="text">Creamy Chicken Alfredo; Price: 523tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-margaritacj.png">
                        </div>
                        <div class="text">Classic Margherita; price: 666tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-chicken alfredo.png">
                        </div>
                        <div class="text">Chicken Alfredo; price: 856tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-macncheez.png">
                        </div>
                        <div class="text">Mac & Cheezstake; price: 618tk</div>
                    </a> 
                </div>
            </div>
        </div>
        <div id="cassic-pizza" class="menu-section">
            <h3>Classic Pizza</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-margaritacj.png">
                        </div>
                        <div class="text">Classic Margherita; price: 666tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-clasic-pepporania.png">
                        </div>
                        <div class="text">The Pepperonia; Price: 809tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-classic-all-about-shroom.png">
                        </div>
                        <div class="text">All about Shrooms; Price: 809tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-classic-fierycornbeef.png">
                        </div>
                        <div class="text">Flery Corned Beef; Price: 856tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-classic-bolognese.png">
                        </div>
                        <div class="text">Bolognese; Price: 856tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-chicken alfredo.png">
                        </div>
                        <div class="text">Chicken Alfredo; price: 856tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-classic-thaipie.png">
                        </div>
                        <div class="text">Thai Pie; price: 999tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-classic-fajita fiesta.png">
                        </div>
                        <div class="text">Fajitas Fiesta; price: 899tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="pasta" class="menu-section">
            <h3>Pasta</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-creamy.png">
                        </div>
                        <div class="text">Creamy Chicken Alfredo; Price: 523tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-macncheez.png">
                        </div>
                        <div class="text">Mac & Cheezstake; price: 618tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-naga-chicken.png">
                        </div>
                        <div class="text">Naga Chicken Bake; price: 523tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pasta-seafood.png">
                        </div>
                        <div class="text">Seafood Marinara; price: 618tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div id="G-pizza" class="menu-section">
            <h3>Gourmet Pizza</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez=g-4cheez.png">
                        </div>
                        <div class="text">The 4 Cheez ; price: 999tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-pizza-mashroom.png">
                        </div>
                        <div class="text">The Kala Bhuna; price: 1047tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-hotcrab.png">
                        </div>
                        <div class="text">Hot Crabby Prawnstar; price: 1047tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-nagastic.png">
                        </div>
                        <div class="text">Nagatastic BBQ; price: 1047tk</div>
                    </a> 
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-smoked-cheddr.png">
                        </div>
                        <div class="text">Smoked Cheddar Tikka; price: 1047tk</div>
                    </a> 
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-meatlovers.png">
                        </div>
                        <div class="text">Meat Lovers Pizza; price: 1249tk</div>
                    </a> 
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-kolongko.png">
                        </div>
                        <div class="text">Kolongko:The Disgrace; price: 1142tk</div>
                    </a> 
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-g-smg.png">
                        </div>
                        <div class="text">Simple Er Modhe Gorgeous:SMG; price: 1142tk</div>
                    </a> 
                </div>
            </div>
        </div>
        </div>
       
        <div id="cheez-boat" class="menu-section">
            <h3>Cheezy Boats</h3>
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
                        <div class="text">Alfredo Garlic; Price: 380tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-banana&nuts.png">
                        </div>
                        <div class="text">Spicy Sausage Garlic; price: 380tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-strawberry-banana.png">
                        </div>
                        <div class="text">Classic Garlic; price: 332tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-fruitybliss.png">
                        </div>
                        <div class="text">Steak Garlic; price: 428tk</div>
                    </a>
                    <!-- <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-verystrawberry.png">
                        </div>
                        <div class="text">Very Very Strawberry; price: 190tk</div>
                    </a> -->
                </div>
            </div>
        </div> 
        <div id="cheez-chow" class="menu-section"></div>
            <h3>Cheezy Chowderz</h3>
            <div class="section0">
                <div class="h1">
                    <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
                </div>
                <div class="box">
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-chowders-tomato.png">
                        </div>
                        <div class="text">Cream of Tomato; Price: 399tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-banana&nuts.png">
                        </div>
                        <div class="text">Cream of Mashroom; price: 449tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/cheez-chowders-bacon.png">
                        </div>
                        <div class="text">Bacon Cheddar Chowder; price: 499tk</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="dessert" class="menu-section">
            <h3>Dessert</h3>
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
                        <div class="text">Classic Burnt Cheesecake; Price: 285tk</div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-banana&nuts.png">
                        </div>
                        <div class="text">Blueberry Sass Burnt Cheesecake; price: 380tk </div>
                    </a>
                    <a class="box11">
                        <div class="img">
                            <img src="assets/Images/waffleup-baily-strawberry-banana.png">
                        </div>
                        <div class="text">Strawberry Affair Burnt Cheesecake; price: 380tk</div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="kfc.js"></script>
</body>


</html>