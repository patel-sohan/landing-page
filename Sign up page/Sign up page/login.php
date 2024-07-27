<?php
// Database credentials
$servername = "srv1264.hstgr.io";
$username = "u206484853_yash007";
$password = "Yashpatel@#$={}306488";
$dbname = "u206484853_logincoll";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $gmail= $_POST['gmail'];

    // Prepare the SQL query to fetch user details
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($pass, $row['password'])) {
            echo "Login successful!";
            // Start a session or redirect to another page
            session_start();
            $_SESSION['username'] = $user;
            header("Location: vidhyaspot.com"); // Redirect to a welcome page
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
