<?php
// Database connection
$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "db_nt3102";

$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login submission
if (isset($_POST["login"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                // Directly compare passwords (not recommended for production)
                if ($password === $user["password"]) {
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Username does not match</div>";
            }

            mysqli_stmt_close($stmt);
        } else {
            die("Preparing the statement failed: " . mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
</head>
<body>

<form action="login.php" method="post">
    <div>Sr Code:</div>
    <input type="text" name="username" placeholder="Sr Code" required><br>
    <div>Password:</div>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Login" name="login">
</form>

</body>
</html>
