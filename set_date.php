<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $email = $_SESSION['email'];

    // Save the confirmed date
    $sql = "UPDATE user_details SET confirmed_date = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $email);

    if ($stmt->execute()) {
        echo "Date saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Date</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .chat-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .chat-box {
            margin-bottom: 20px;
        }

        .chat-message p {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .calendar {
            flex: 2;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .send-button {
            flex: 1;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }

        .send-button:hover {
            background-color: #0056b3;
        }

        .response-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        .response-button:hover {
            background-color: #218838;
        }

        .response-button:last-child {
            background-color: #dc3545;
        }

        .response-button:last-child:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-box">
            <!-- Chat messages will appear here -->
            <div class="chat-message">
                <p><strong>User 1:</strong> <span id="date-message"></span></p>
            </div>
            <div id="response"></div>
        </div>
        <div class="input-container">
            <!-- Calendar input for selecting the date -->
            <input type="date" id="date-input" class="calendar">
            <button onclick="sendDate()" class="send-button">Send</button>
        </div>
    </div>

    <script>
        function sendDate() {
            const dateInput = document.getElementById('date-input').value;
            const messageBox = document.getElementById('date-message');
            const responseBox = document.getElementById('response');

            if (dateInput) {
                // Display the selected date as a message
                messageBox.textContent = dateInput;

                // AJAX request to save the date
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'set_date.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        alert('Date confirmed: ' + this.responseText);
                    }
                };
                xhr.send('date=' + encodeURIComponent(dateInput));

                // Show the OK and Change Date buttons
                responseBox.innerHTML = `
                    <button onclick="confirmDate()" class="response-button">OK</button>
                    <button onclick="changeDate()" class="response-button">Change Date</button>
                `;
            }
        }

        function confirmDate() {
            alert('Date confirmed!');
            // Additional logic for confirming the date can be added here
        }

        function changeDate() {
            document.getElementById('date-input').value = '';
            document.getElementById('date-message').textContent = '';
            document.getElementById('response').innerHTML = '';
        }
    </script>
</body>
</html>
