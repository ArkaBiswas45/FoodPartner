<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1); // Show errors on the screen
ini_set('display_startup_errors', 1); // Show startup errors
error_reporting(E_ALL); // Report all errors and warnings

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Step 2</title>
    <link rel="stylesheet" href="signup2.css">
</head>
<body>
    <div class="all">
        <form class="form" action="signup2.php" method="post" enctype="multipart/form-data">
            <h2>Sign Up-2</h2>
            <div class="gender">
                <label>Pick Your Gender</label>
                <input type="radio" id="male" name="gender" value="M" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="F">
                <label for="female">Female</label>
                <input type="radio" id="others" name="gender" value="O">
                <label for="others">Others</label>
            </div>
            <div class="dob">
                <label for="dob">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="designation">
                <label for="designation">Designation</label>
                <input type="text" id="designation" name="designation" required>
            </div>
            <div class="pictures">
                <label for="profile_pic">Add Your Pictures</label>
                <input type="file" id="profile_pic" name="profile_pic" required>
            </div>
            <div class="foodBox">
                <label>Select your favourite types of Food:</label>
                <div class="foods">
                    <div class="f1">
                        <input type="checkbox" id="american" name="food_preferences[]" value="american">
                        <label for="american">American</label><br>
                        <input type="checkbox" id="chinese" name="food_preferences[]" value="chinese">
                        <label for="chinese">Chinese</label><br>
                        <input type="checkbox" id="french" name="food_preferences[]" value="french">
                        <label for="french">French</label><br>
                    </div>
                    <div class="f1">
                        <input type="checkbox" id="italian" name="food_preferences[]" value="italian">
                        <label for="italian">Italian</label><br>
                        <input type="checkbox" id="indian" name="food_preferences[]" value="indian">
                        <label for="indian">Indian</label><br>
                        <input type="checkbox" id="japanese" name="food_preferences[]" value="japanese">
                        <label for="japanese">Japanese</label><br>
                    </div>
                    <div class="f1">
                        <input type="checkbox" id="korean" name="food_preferences[]" value="korean">
                        <label for="korean">Korean</label><br>
                        <input type="checkbox" id="mexican" name="food_preferences[]" value="mexican">
                        <label for="mexican">Mexican</label><br>
                        <input type="checkbox" id="thai" name="food_preferences[]" value="thai">
                        <label for="thai">Thai</label><br>
                    </div>
                </div>
            </div>
            <div class="email">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly required>
            </div>
            <div class="btn">
                <input type="submit" value="Submit" class="submit">
            </div>
        </form>
    </div>
</body>
</html>

<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Users1345";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $designation = $_POST['designation'];
    $email = $_SESSION['email']; // Use email from session

    // Debugging: Output the $_POST data and $_FILES array
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    // File upload handling
    $target_dir = "uploads/";
    $profile_pic = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile_pic, PATHINFO_EXTENSION));

    // Debugging: Check if the file was uploaded
    if ($_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        echo "Upload failed with error code: " . $_FILES['profile_pic']['error'];
    }

    // Check if file is an actual image
    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (500KB limit)
    if ($_FILES["profile_pic"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Debugging: Check if the file is moving to the target directory
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic)) {
            echo "The file ". basename($_FILES["profile_pic"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo "<br>Debugging info: ";
            print_r($_FILES);
        }
    }

    // JSON encode food preferences
    $food_preferences = json_encode($_POST['food_preferences']);

    // SQL to insert data into user_details table
    $sql = "INSERT INTO user_details (email, gender, date_of_birth, designation, profile_pic, food_preferences) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $email, $gender, $date_of_birth, $designation, $profile_pic, $food_preferences);

    if ($stmt->execute()) {
        echo "Record successfully inserted into user_details table.";

        // Redirect to login page after successful insertion
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
