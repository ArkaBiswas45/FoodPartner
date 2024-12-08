<?php
if (isset($_GET['location'])) {
    // Get the location entered by the user
    $location = strtolower(trim($_GET['location'])); // Convert to lowercase for matching

    // Map of valid locations to their corresponding pages
    $locationPages = [
        'gulshan' => 'gulshan.php',
        'khilgaon' => 'khilgaon.php',
        'bashundhara' => 'bashundhara.php',
        'bailey road' => 'bailyroad.php',
        'baily road' => 'bailyroad.php',
        'dhanmondi' => 'dhanmondi.php',
        'dhanmondi-5' => 'dhanmondi.php',
        'dhanmondi-13' => 'dhanmondi.php',
        'wari' => 'wari.php',
        'shonir akhra' => 'shonirakhra.php',
        'mirpur' => 'mirpur.php',
        'uttara' => 'uttara.php',
        'banasree' => 'banasree.php',
        'shyamoli' => 'shyamoli.php',
        'mohammadpur' => 'mohammadpur.php',
        'banani' => 'banani.php',
        'old_dhaka' => 'old_dhaka.php'
    ];

    // Check if the location exists in the map
    if (array_key_exists($location, $locationPages)) {
        // Redirect to the corresponding page
        header("Location: " . $locationPages[$location]);
        exit;
    } else {
        // If location is not found, redirect to a default page or show an error
        echo "<p>Sorry, no restaurants found for the specified location.</p>";
    }
} else {
    // If no location is provided, redirect to a default page or home
    header("Location: location.php");
    exit;
}