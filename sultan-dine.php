<?php
include 'track_visit.php';  // This will track the visit count
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sultan's Dine Restaurant</title>
   <link rel="stylesheet" href="sultandine.css">
</head>
<body>
   <header>
       <div class="header-content">
           <img src="assets/Images/sultan-dine-logo.png" alt="Sultan's Dine Logo" class="logo">
           <div class="header-text">
               <h1>Sultan's Dine Restaurant</h1>
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
           <a class="box1" >
              <!-- <div class="img">
                   <img src="assets/Images/desktop_landing_EndltB.png.webp" alt="KFC-Dhanmondi">
               </div>-->
               <div class="text"><h2>25% off (COMEBACK)</h2>
                                 25% off with code comeback.<br>
                                 Min. order tk 299. Discount capped at 75tk<br>
                                 Valid for all items
                                 <h4>Valid from 03 June to 30 June,2024</h4>
               </div>
           </a>
           <a class="box1" >
               
               <div class="text"><h2>100% off (COMEBACK)</h2>
                100% off with code comeback.<br>
                Min. order tk 499.<br>
                Valid for all items
                <h4>Valid from 03 June to 30 June,2024</h4></div>
           </a>
           <a class="box1">
             
               <div class="text"><h2>80tk off (Nagad)</h2>
                80tk off with code Nagad80.<br>
                Min. order tk 399.<br>
                Valid for all items
                <h4>Valid from 03 June to 30 June,2024</h4></div>
           </a>
           <a class="box1" >
               
               <div class="text"><h2>50tk off (Bkash)</h2>
                50tk off with code Bkash50.<br>
                Min. order tk 299.<br>
                Valid for all items
                <h4>Valid from 03 June to 30 June,2024</h4></div>
           </a>
       </div>
   </div>
   <section id="menu">
       <h3>Menu</h3>
       <nav>
           <ul>
               <li><a href="#popular">Popular</a></li>
               <li><a href="#kacchi">Kacchi</a></li>
               <li><a href="#polao">Polao & Roasts</a></li>
               <li><a href="#desserts">Desserts & Beverages</a></li>
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
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultandine-kacchi-basmati.webp" >
                       </div>
                       <div class="text">Kacchi(Basmati)Full; price:499tk
                       </div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-rezala.jpeg" >
                       </div>
                       <div class="text">Beef Rezala; price:200tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultandine-polao.png" >
                       </div>
                       <div class="text">Plain Polao; price:299tk
                       </div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-borhani.jpeg" >
                       </div>
                       <div class="text">Borhani; price: 70tk</div>
                   </a>
               </div>
           </div>
       </div>
       <div id="kacchi" class="menu-section">
           <h3>Kacchi</h3>
           <div class="section0">
               <div class="h1">
                   <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
               </div>
               <div class="box">
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-kacchi-basmati-half.webp" >
                       </div>
                       <div class="text">Kacchi(Basmati)Half; price:299tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultandine-kacchi-basmati.webp" >
                       </div>
                       <div class="text">Kacchi(Basmati)Full; price:499tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-kacchi-platter.jpeg" >
                       </div>
                       <div class="text">Kacchi Platter; price:999tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-kacchi-muttontehari.jpeg">
                       </div>
                       <div class="text">Mutton Tehari; price: 250tk</div>
                   </a>
               </div>
           </div>
       </div>
       </div>
       <div id="polao" class="menu-section">
           <h3>Polao & Roasts</h3>
           <div class="section0">
               <div class="h1">
                   <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
               </div>
               <div class="box">
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/sultandine-polao.png">
                       </div>
                       <div class="text">Plain Polao; price:120tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-roasts.jpeg" >
                       </div>
                       <div class="text">Chicken Roasts; price:150tk </div>
                   </a>
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/sultan-dine-polao-platter.webp" >
                       </div>
                       <div class="text">Plain Polao Platter with Chicken roast,Beef rezala,Jali kebab,Borhani & Chutney; price: 649tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-halh-polao-platter.webp">
                       </div>
                       <div class="text">Plain Polao Platter with Chicken roast & Borhani; price:299tk</div>
                   </a>
               </div>
           </div>
       </div>
       </div>
       <div id="desserts" class="menu-section">
           <h3>Desserts & Beverages</h3>
           <div class="section0">
               <div class="h1">
                   <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
               </div>
               <div class="box">
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/sultan-dine-firni.webp" >
                       </div>
                       <div class="text">Firni; price:</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-borhani.jpeg" >
                       </div>
                       <div class="text">Borhani; price: 70tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/sultan-dine-jorda.jpeg" >
                       </div>
                       <div class="text">Jorda; price: 70tk</div>
                   </a>
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/sultan-dine-jafranisarbat.jpeg" >
                       </div>
                       <div class="text">Jafrani sharbat; price:90tk</div>
                   </a>
               </div>
           </div>
       </div>
       </div>
   </section>
   <script src="kfc.js"></script>
</body>
</html>