<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password (for better security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to check login credentials
    $sql = "SELECT * FROM security WHERE Username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify hashed password
        if (password_verify($password, $row["Password"])) {
            echo "Login successful!";
            // You can redirect or perform other actions here
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Username not found!";
    }
}

$conn->close();
?>
