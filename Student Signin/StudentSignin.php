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

    // Check if Sr_code follows the format 00-00000
    if (!preg_match('/^\d{2}-\d{5}$/', $sr_code)) {
        echo "Sr_code should follow the format 00-00000.";
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
            header("Location: /Student View Lost/StudentView.html"); // Replace with the correct path
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        // User does not exist, insert new user
        $insert_user_query = "INSERT INTO student (Sr_code, Password) VALUES ('$sr_code', '$password')";
        if ($conn->query($insert_user_query) === TRUE) {
            echo "Sign up successful !";
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="showPopup()">
        <label for="sr_code">Sr_code:</label>
        <input type="text" id="sr_code" name="sr_code" pattern="\d{2}-\d{5}" title="Sr_code should follow the format 00-00000." required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" pattern=".*-.*" title="Password should contain a hyphen." required><br>

        <input type="submit" value="Submit">
    </form>

    <!-- Popup content -->
    <div id="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; background-color: #f1f1f1; border: 1px solid #d4d4d4; border-radius: 5px; text-align: center;">
        <p>Welcome! If it's your first time, just enter your Sr-code as the password.</p>
        <button onclick="closePopup()">OK</button>
    </div>

    <!-- JavaScript for the popup -->
    <script>
        function showPopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            return true; // Continue with form submission
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }
    </script>
</body>
</html>
