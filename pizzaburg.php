<?php
include 'track_visit.php';  // This will track the visit count
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pizzaburg Restaurant</title>
   <link rel="stylesheet" href="pizzaburg.css">
</head>
<body>
   <header>
       <div class="header-content">
           <img src="assets/Images/pizzaburglogo.jpg" alt="Pizzaburg Logo" class="logo">
           <div class="header-text">
               <h1>PizzaBurg Restaurant</h1>
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
               <li><a href="#pizza">Pizza</a></li>
               <li><a href="#set-menu">Set Menu</a></li>
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
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-cheddar-cream.jpeg" >
                       </div>
                       <div class="text">Cheddar Cream Pizza;Medium; price:450tk
                       </div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburgbeef-volcano.jpeg" >
                       </div>
                       <div class="text">Beef Cheese Volacano;price: 379tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-sausage-carnival.jpeg" >
                       </div>
                       <div class="text">Sausage Carnival Pizza;Medium; Price: 455tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-setmenu4.jpg" >
                       </div>
                       <div class="text">Fat Boy; price: 319tk</div>
                   </a>
               </div>
           </div>
       </div>
       <div id="pizza" class="menu-section">
           <h3>Pizza</h3>
           <div class="section0">
               <div class="h1">
                   <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
               </div>
               <div class="box">
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-4-flavour.jpg" >
                       </div>
                       <div class="text"> Four Flavour Pizza;Medium; price: 475tk </div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-cheddar-cream.jpeg" >
                       </div>
                       <div class="text"> Cheddar Cream Pizza;Medium; price:450tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-meat-machine.jpeg" >
                       </div>
                       <div class="text">BBQ Meat Machine Pizza;Medium; Price:455tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-sausage-carnival.jpeg">
                       </div>
                       <div class="text">Sausage Carnival Pizza;Medium; Price: 455tk </div>
                   </a>
               </div>
           </div>
       </div>
       </div>
       <div id="set-menu" class="menu-section">
           <h3>Set Menu</h3>
           <div class="section0">
               <div class="h1">
                   <!-- <span>Your daily Deals</span>
                   <span class="text"><a href="see-all">See all</a></span> -->
               </div>
               <div class="box">
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/pizzaburg-setmenu1.jpeg">
                       </div>
                       <div class="text">Set Menu-1; price:199tk </div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-setmenu2.jpg" >
                       </div>
                       <div class="text">Set Menu-2;price:279tk </div>
                   </a>
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/pizzaburg-setmenu3.jpg" >
                       </div>
                       <div class="text">Set Menu-3; price: 349tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-setmenu4.jpg">
                       </div>
                       <div class="text">Fat Boy; price: 319tk</div>
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
                           <img src="assets/Images/pizzaburg-bbq-chic-burger.jpg" >
                       </div>
                       <div class="text"> BBQ Chicken Burger;price:219tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-chic-tounge-burger.jpg" >
                       </div>
                       <div class="text">Chicken Tongue Slayer; price: 229tk</div>
                   </a>
                   <a class="box11" >
                       <div class="img">
                           <img src="assets/Images/pizzaburg-chic-volcano.jpg" >
                       </div>
                       <div class="text">Chicken Cheese Volcano; price: 339tk</div>
                   </a>
                   <a class="box11">
                       <div class="img">
                           <img src="assets/Images/pizzaburgbeef-volcano.jpeg" >
                       </div>
                       <div class="text">Beef Cheese Volacano;price: 379tk</div>
                   </a>
               </div>
           </div>
       </div>
       </div>
   </section>
   <script src="kfc.js"></script>
</body>
</html>