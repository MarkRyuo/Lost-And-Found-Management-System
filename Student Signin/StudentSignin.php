<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data
    $sr_code = $_POST["sr_code"];
    $password = $_POST["password"];

    // Check if Sr_code is a 7-digit number
    if (!preg_match('/^\d{7}$/', $sr_code)) {
        echo "Sr_code should be a 7-digit number.";
        $conn->close();
        exit();
    }

    // Check if password contains a hyphen
    if (strpos($password, '-') === false) {
        echo "Password should contain a hyphen.";
        $conn->close();
        exit();
    }

    // Check if user exists
    $check_user_query = "SELECT * FROM student WHERE Sr_code = '$sr_code'";
    $result = $conn->query($check_user_query);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {
            // Login successful, redirect to a new page
            header("Location: welcome.php"); // Replace "welcome.php" with the desired page
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        // User does not exist, insert new user
        $insert_user_query = "INSERT INTO student (Sr_code, Password) VALUES ('$sr_code', '$password')";
        if ($conn->query($insert_user_query) === TRUE) {
            echo "Sign up successful!";
            // Add your login logic here
        } else {
            echo "Error: " . $insert_user_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>
<body>
    <h2>Login System</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="sr_code">Sr_code:</label>
        <input type="text" id="sr_code" name="sr_code" pattern="\d{7}" title="Sr_code should be a 7-digit number." required><br>


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" pattern=".*-.*" title="Password should contain a hyphen." required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
