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
            header("Location: /Student View Lost/ViewlostItemStudent.php"); // Replace with the correct path
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
    <link rel="stylesheet" href="/Student Signin/StudentSign.css">
    <link rel="stylesheet" href="/Student Signin/popup.css">
    <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">
    <title>Student Signin | Lost ang found</title>
</head>
<body> 
    <!-- Popup content -->
    <div id="popup">

        <section class="sec-popup">

        <div class="img-box">
            <img src="/assets/Images/Batstatelogo.png" alt="Logo of Bsu" style="width: 300px; opacity:60%;">
        </div>


        <div class="text-popup">
            <h1>Welcome Student</h1>
            <p><mark>Reminder!</mark> If it's your first time, just enter your Sr-code as a Username and password. <br>Ex. Sr-code: 21-00000</p>

            <!-- Btn start -->
            <button onclick="closePopup()" id="btnpopup">OK</button>
            <!-- btn end -->
        </div>

        </section>
    </div>

    <div class="container">
    <!-- End Popup content -->
        <section class="sec-form">
            <form method="post" class="Form-Signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <h1>Signin</h1>
                <label for="sr_code">Sr_code:</label>
                <input type="text" id="sr_code" name="sr_code" pattern="\d{2}-\d{5}" title="Sr_code should be a 7-digit number and contain a hypen." required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" pattern="\d{2}-\d{5}" title="Sr_code should be a 7-digit number and contain a hypen." required><br>

                <input type="submit" value="Signin" class="sign-btn">

            </form>
        </section>

        <div class="blank">
        </div>

    </div>
</body>
    <script src="/Student Signin/Popup.js"></script>
</html>
