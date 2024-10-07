<?php
session_start();

$initials = '';
$profilePicUrl = 'assets/Images/default-profile.png'; // Default profile image

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // Extract the first character of email and convert it to uppercase
    $initials = strtoupper($email[0]);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch profile picture URL if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Prepare and execute query to get profile picture URL
        $stmt = $conn->prepare("SELECT profile_pic FROM user_details WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($profilePicUrl);

        if (!$stmt->fetch() || empty($profilePicUrl)) {
            // If profile picture not found or empty, use default
            $profilePicUrl = 'assets/Images/default-profile.png';
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Partner</title>
    <link rel="stylesheet" href="resturants.css">
</head>

<body>
<header>
        <nav>
            <div class="logo">
                <img src="assets/Images/logo2.png" alt="img">
                <p>Food Partner</p>
            </div>
            <div class="nav1">
                <ul>
                    <li><a href="home1.php">Home</a></li>
                    <li><a href="resturants.php">Restaurants</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="favourites.php">Favourites</a></li>
                    <li><a href="foodpartner.php">Food Partner</a></li>
                </ul>
            </div>
            <div class="nav2">
                <ul>
                    <?php if (!isset($_SESSION['loggedin'])): ?>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="signup1.html">Sign Up</a></li>
                    <?php else: ?>

                        <!-- Profile Dropdown -->
                        
                    <li class="profile-dropdown">
                        <button class="profile-toggle">
                            <!-- Always display profile picture -->
                            <img src="<?php echo htmlspecialchars($profilePicUrl); ?>" alt="Profile Picture" class="profile-img">
                        </button>
                        <div class="profile-menu">
                            <a href="profile.php">Profile</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>


                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="separation"></div>
    </header>

    <main>
        <div class="section1">
            <div class="hero">
                <span>
                    Find Your Perfect Resturant.
                </span>
            </div>
            <div class="search">
                <input type="search" placeholder="Search">
            </div>
            
        </div>

        <div class="separation"></div>

        <div class="section2">
            <!-- <div class="h1">Things To Do</div> -->
            <div class="box">
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/a-pointer-on-a-map-showing-restaurants-day-with-bl-ayMS1yPMQo-7im-fI0KFKg-sY8RAxUVTOuo1T7lf028Cw.jpeg"
                            alt="">
                    </div>
                    <div class="text">
                        <div>Find The Best Places to Eat</div>
                        <div> 4.3 million restaurants — everything from street food to fine dining</div>
                    </div>
                </div>
                <div class="box1 box2">
                    <div class="img">
                        <img src="assets/Images/review pic.png"
                            alt="">
                    </div>
                    <div class="text">
                        <div>See the latest Reviews</div>
                        <div> Millions of restaurant reviews and photos from our global travel community</div>
                    </div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/a-dining-table-in-a-restaurant-adorned-with-a-sele-EJpukcRkSUSEsRZaxa5nCw-XXed1kYLQAOsVS951lJZaA.jpeg"
                            alt="">
                    </div>
                    <div class="text">
                        <div>Reserve A Table</div>
                        <div>You can make online reservation for a meal or a party</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="separation"></div>

        <div class="section0">
            <div class="h1">
                <span>Your daily Deals</span>
                <span class="text"><a href="see-all">See all</a></span>
            </div>
            <div class="box">
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/desktop_landing_EndltB.png.webp" alt="">
                    </div>
                    <div class="text"><a href="resturants/kfc.html">KFC-Dhanmondi</a></div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/desktop_landing_EnGBjY.png.webp" alt="">
                    </div>
                    
                    <div class="text"><a href="uni-cafe">UniCafe-Wari</a></div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/desktop_landing_EnJoJF.png.webp" alt="">
                    </div>
                    
                    <div class="text"><a href="PizzaBurg-wari">PizzaBurg-Wari</a></div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/desktop_landing_EnZwCd.png.webp" alt="">
                    </div>
                    
                    <div class="text"><a href="Sultan's-Dine">Sultan's-Dine-Dhanmondi</a></div>
                </div>
            </div>
        </div>

        <div class="separation"></div>

        <div class="center">
            <div class="left">
                <div class="filter-option">
                    <h2>Sort By</h2>
                    <select>
                        <option value="relevance">Relevance</option>
                        <option value="popularity">Popularity</option>
                        <option value="rating">Rating</option>
                        <option value="distance">Distance</option>
                    </select>
                </div>
                <div class="filter-option">
                    <h2>Quick Filters</h2>
                    <label><input type="checkbox" name="open-now"> Open Now</label>
                    <label><input type="checkbox" name="offers"> Offers</label>
                    <label><input type="checkbox" name="top-rated"> Top Rated</label>
                </div>
                <div class="filter-option">
                    <h2>Offers</h2>
                    <label><input type="checkbox" name="discount"> Discount</label>
                    <label><input type="checkbox" name="happy-hour"> Happy Hour</label>
                </div>
                <div class="filter-option">
                    <h2>Cuisines</h2>
                    <select>
                        <option value="all">All</option>
                        <option value="italian">Italian</option>
                        <option value="chinese">Chinese</option>
                        <option value="indian">Indian</option>
                        <option value="mexican">Mexican</option>
                    </select>
                </div>
                <div class="filter-option">
                    <h2>Price</h2>
                    <label><input type="radio" name="price" value="low-to-high"> Low to High</label>
                    <label><input type="radio" name="price" value="high-to-low"> High to Low</label>
                </div>
                <button class="add-filter-btn">Add Filter</button>
            </div>

            <div class="right">
                <div class="section3">
                    <div class="h1">
                        <span>Top Experiences on Food Partner</span>
                        <span class="text"><a href="see-all">See all</a></span>
                    </div>
                    <div class="box">
                        <div class="box1">
                            <div class="img"><img src="assets/Images/skyline3.jpg" alt=""></div>
                            <div class="text"><a href="KFC-Dhanmondi">Grill On The Skyline</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/birds-eye-view-of-green-rooftop-terraces-moorgate-exchange-london-G2TP32.jpg" alt=""></div>
                            <div class="text"><a href="uni-cafe">Birds Eye Roof Top</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/buriganga-river.jpg" alt=""></div>
                            <div class="text"><a href="PizzaBurg-wari">Buriganga Riverview Restaurants</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/lake-terrace.jpg" alt=""></div>
                            <div class="text"><a href="Sultan's-Dine">Lake Terrace</a></div>
                        </div>
                    </div>
                </div>
                <div class="separation"></div>

                <div class="section3">
                    <div class="h1">
                        <span>Top Places in Dhaka</span>
                        <span class="text"><a href="see-all">See all</a></span>
                    </div>
                    <div class="box">
                        <div class="box1">
                            <div class="img"><img src="assets/Images/Gulshan.jpg" alt=""></div>
                            <div class="text"><a href="KFC-Dhanmondi">Gulshan</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/Banani-Cover-Alt.jpg" alt=""></div>
                            <div class="text"><a href="uni-cafe">Banani</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/baily-road.jpg" alt=""></div>
                            <div class="text"><a href="PizzaBurg-wari">Baily Road</a></div>
                        </div>
                        <div class="box1">
                            <div class="img"><img src="assets/Images/dhanmondi.jpg" alt=""></div>
                            <div class="text"><a href="Sultan's-Dine">Dhanmondi</a></div>
                        </div>
                    </div>
                </div>
        

        <div class="separation"></div>



        <footer>
            <div class="credit">
                <span><img src="assets/Images/logo2.png" alt="img"></span>
                <span>© 2024 Food Partner LLC All rights reserved.</span>
            </div>
            <div class="faq">
                <div class="faq1">
                    <a href="FAQ">FAQ</a>
                    <a href="Privacy">Privacy</a>
                    <a href="Help Center">Help Center</a>
                </div>
                <div class="faq1">
                    <a href="Contact">Contact</a>
                    <a href="Cokie-Preferences">Cokie-Preferences</a>
                    <a href="Terms of use">Terms of use</a>
                </div>
            </div>
        </footer>
    </main>
    <script src="home1.js"></script>
    <script src="home.js"></script>
</body>

</html>