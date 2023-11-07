<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php
require_once "database.php";

if (isset($_POST["login"])) {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));

        $sql = "SELECT * FROM tbl_student WHERE emailaddress = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($user) {
            if (password_verify($password, $user["password"])) {
                header("Location: index.php");
                die();
            } else {
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Email does not match</div>";
        }
    }
}
?>

    <form action="studentlogin.php" method="post">
        <div>Email Address:</div>
        <input type="email"  name="email" placeholder="Email Address" >
        <div>Password</div>
        <input type="password" name="password" placeholder="Password"> </br>
        <input type="submit" value="Login" name="login">
    </form>
</body>
</html>