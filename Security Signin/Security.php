<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Security Signin/Security.css">
    <title>Security Signin | Lost and Found</title>
</head>
<body>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_nt3102";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user input
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Protect against SQL injection
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // Check user credentials
        $query = "SELECT * FROM security WHERE Username='$username' AND Password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // Successful login
            $_SESSION['username'] = $username;
            header("Location: \Home\Home.html");
            exit();
        } else {
            // Failed login
            echo "Invalid username or password";
        }

        $conn->close();
    }
    ?>
    <div class="container">
        <section class="sec-form">

            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="Form-Signin">
                <h1>SignIn</h1>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br>

                <input type="submit" value="Login" class="sign-btn">
            </form>
        </section>
        <div class="blank">
            </div>
    </div>
</body>
</html>
