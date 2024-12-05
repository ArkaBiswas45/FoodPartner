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

// Handle search query
if (isset($_GET['search'])) {
    $searchQuery = strtolower(trim($_GET['search']));

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



    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Partner</title>
    <link rel="stylesheet" href="home.css">
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
                                <a href="messages.php"><svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M50 100C77.6142 100 100 77.6142 100 50C100 22.3858 77.6142 0 50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100ZM27.1967 32.1967C28.6032 30.7902 30.5109 30 32.5 30H67.5C69.4891 30 71.3968 30.7902 72.8033 32.1967C74.2098 33.6032 75 35.5109 75 37.5V62.5C75 64.4891 74.2098 66.3968 72.8033 67.8033C71.3968 69.2098 69.4891 70 67.5 70H32.5C30.5109 70 28.6032 69.2098 27.1967 67.8033C25.7902 66.3968 25 64.4891 25 62.5V37.5C25 35.5109 25.7902 33.6032 27.1967 32.1967ZM51.775 49.7L66.475 35H33.525L48.225 49.7C48.4574 49.9343 48.7339 50.1203 49.0386 50.2472C49.3432 50.3741 49.67 50.4395 50 50.4395C50.33 50.4395 50.6568 50.3741 50.9614 50.2472C51.2661 50.1203 51.5426 49.9343 51.775 49.7ZM69.2678 64.2678C69.7366 63.7989 70 63.163 70 62.5V38.525L55.3 53.225C53.8937 54.6295 51.9875 55.4184 50 55.4184C48.0125 55.4184 46.1063 54.6295 44.7 53.225L30 38.525V62.5C30 63.163 30.2634 63.7989 30.7322 64.2678C31.2011 64.7366 31.837 65 32.5 65H67.5C68.163 65 68.7989 64.7366 69.2678 64.2678Z" fill="#1344bf" id="id_102"></path>
                                    </svg></a>
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
            <div class="search">
                <form action="" method="get">
                    <div class="sinput">
                        <input type="search" name="search" placeholder="Food or Restaurants">
                        <button type="submit"><img src="assets/Images/search-engine-magnifying-glass-svgrepo-com.svg" alt=""></button>
                    </div>
                </form>
            </div>
            <div class="hero">
                <span>Welcome to our all-in-one destination for dining and socializing!</span>
                <span>Our website not only helps you discover fantastic restaurants but also connects</span>
                <span>you with potential partners or friends to share those dining experiences with.</span>
                <span>Whether you're looking for a cozy dinner spot for a romantic date or seeking new</span>
                <span>friends to explore the culinary scene together, we've got you</span>
            </div>
        </div>

        <div class="separation"></div>


        <div class="section2">
            <div class="h1">Things To Do</div>
            <div class="box">
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/a-pointer-on-a-map-showing-restaurants-day-with-bl-ayMS1yPMQo-7im-fI0KFKg-sY8RAxUVTOuo1T7lf028Cw.jpeg" alt="">
                    </div>
                    <div class="text">
                        <div>Find Resturants Near You</div>
                        <div>You can find available restaurants near you based on your food preferences. You can also find restaurants in a different location where you want to go.</div>
                    </div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/a-man-and-woman-sitting-on-a-chair-in-a-table-in-a-TzjDVwIbRVaY0dBGXMlsqg-Y6UXcZjLT1G-R4qnG0Ffdg.jpeg" alt="">
                    </div>
                    <div class="text">
                        <div>Find a Friend</div>
                        <div>You can not only find foods in our website but also a food partner to share amazing dining experience together. We use AI matching algorithm to find you a friend.</div>
                    </div>
                </div>
                <div class="box1">
                    <div class="img">
                        <img src="assets/Images/a-dining-table-in-a-restaurant-adorned-with-a-sele-EJpukcRkSUSEsRZaxa5nCw-XXed1kYLQAOsVS951lJZaA.jpeg" alt="">
                    </div>
                    <div class="text">
                        <div>Reserve A Table</div>
                        <div>You can make online reservation for a meal or a party</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="separation"></div>


        <div class="section3">
            <div class="h1">
                <span>Most Visited Restaurents</span>
                <span class="text"><a href="most_visited.php">See all</a></span>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="assets/Images/KFC-2024-04-26 at 2.30.21 AM.png" alt="">
                    <div class="text"><a href="kfc.php">KFC-Dhanmondi</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/unicafe.jpeg" alt="">
                    <div class="text"><a href="burgerxpress.php">burgerxpress</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/Pizzaburg.jpg" alt="">
                    <div class="text"><a href="pizzaburg.php">PizzaBurg-Wari</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/sultans_kacchi.jpg" alt="">
                    <div class="text"><a href="sultan-dine.php">Sultan's-Dine-Dhanmondi</a></div>
                </div>
            </div>
        </div>


        <div class="separation"></div>


        <div class="section4">
            <div class="h1">
                <span>Most Popular Foods</span>
                <span><a href="most_popular.php">See all</a></span>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="assets/Images/burger-express.jpg.webp" alt="">
                    <div class="text"><a href="burger.php">Burger</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/LindseyEats_Spicy_Garlic_Noodles-3.jpg" alt="">
                    <div class="text"><a href="Noodles">Noodles</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/Pizzaburg.jpg" alt="">
                    <div class="text"><a href="pizza.php">Pizza</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/crabs.jpg" alt="">
                    <div class="text"><a href="SCrabs">Crabs</a></div>
                </div>
                <div class="box1">
                    <img src="assets/Images/sultans_kacchi.jpg" alt="">
                    <div class="text"><a href="Kacchi">kacchi</a></div>
                </div>
            </div>
        </div>
        <!-- <div class="msg">
        <a href="messages.php">message</a>
       </div> -->


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