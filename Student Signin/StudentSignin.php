<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    
    <?php
    // PHP code for handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve values from the form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validate the login (in this example, check if the username and password match)
        if (checkIfUserExists($username, $password)) {
            echo "<p>Login successful!</p>";
        } else {
            // If the user doesn't exist or the password is incorrect, display an error message
            echo "<p>Login failed. Please check your username and password.</p>";
        }
    }

    function checkIfUserExists($username, $password) {
        // Implement your database check here
        // For demonstration, assume a database connection and a users table with username and password columns
        $servername = "your_server_name";
        $dbname = "your_database_name";
        $username_db = "your_database_username";
        $password_db = "your_database_password";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password); // Note: In a real application, you should hash the password before comparing

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conn = null;
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
