<?php
session_start();
include 'count_unreadReq.php';
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
// Handle search query
if (isset($_GET['search'])) {
    $searchQuery = strtolower(trim($_GET['search']));

    // Check if the search query is empty
    if (empty($searchQuery)) {
        echo "Please enter a search term.";
        exit();
    }

    // Fetch all search terms from the database
    $sql = "SELECT search_term, page_name FROM search_mappings";
    $result = $conn->query($sql);

    $closestMatch = null;
    $closestPage = null;
    $shortestDistance = -1;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchTerm = strtolower($row['search_term']);
            $pageName = $row['page_name'];

            // Calculate Levenshtein distance between the search query and the search term
            $distance = levenshtein($searchQuery, $searchTerm);

            // If this is the closest match or the first match
            if ($shortestDistance == -1 || $distance < $shortestDistance) {
                $closestMatch = $searchTerm;
                $closestPage = $pageName;
                $shortestDistance = $distance;
            }
        }
    }

    // Set a threshold for acceptable matches (adjust based on the length of terms)
    $threshold = 3; // Acceptable distance for misspellings
    if ($shortestDistance != -1 && $shortestDistance <= $threshold) {
        // Redirect to the closest matching page
        header("Location: " . $closestPage);
        exit();
    } else {
        // Handle the case where no close match is found
        echo "No matching page found for the search term.";
    }
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
                    <li>
                            <div class="msg">
                                <a href="messages.php">
                                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M50 100C77.6142 100 100 77.6142 100 50C100 22.3858 77.6142 0 50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100ZM27.1967 32.1967C28.6032 30.7902 30.5109 30 32.5 30H67.5C69.4891 30 71.3968 30.7902 72.8033 32.1967C74.2098 33.6032 75 35.5109 75 37.5V62.5C75 64.4891 74.2098 66.3968 72.8033 67.8033C71.3968 69.2098 69.4891 70 67.5 70H32.5C30.5109 70 28.6032 69.2098 27.1967 67.8033C25.7902 66.3968 25 64.4891 25 62.5V37.5C25 35.5109 25.7902 33.6032 27.1967 32.1967ZM51.775 49.7L66.475 35H33.525L48.225 49.7C48.4574 49.9343 48.7339 50.1203 49.0386 50.2472C49.3432 50.3741 49.67 50.4395 50 50.4395C50.33 50.4395 50.6568 50.3741 50.9614 50.2472C51.2661 50.1203 51.5426 49.9343 51.775 49.7ZM69.2678 64.2678C69.7366 63.7989 70 63.163 70 62.5V38.525L55.3 53.225C53.8937 54.6295 51.9875 55.4184 50 55.4184C48.0125 55.4184 46.1063 54.6295 44.7 53.225L30 38.525V62.5C30 63.163 30.2634 63.7989 30.7322 64.2678C31.2011 64.7366 31.837 65 32.5 65H67.5C68.163 65 68.7989 64.7366 69.2678 64.2678Z" fill="#1344bf"></path>
                                    </svg>
                                    <?php if ($totalUnreadMessages > 0): ?>
                                        <span class="badge"><?php echo $totalUnreadMessages; ?></span>
                                    <?php endif; ?>
                                </a>
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
                <form action="" method="get">
                    <div class="sinput">
                        <input type="search" name="search" placeholder="Food or Restaurants">
                        <!-- <button type="submit">Search</button> -->
                    </div>
                </form>
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

        <!-- <div class="section0">
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
        </div>s

        <div class="separation"></div> -->

        <div class="center">
            <!-- <div class="left">
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
            </div> -->

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