<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="style/studentlogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500&family=Inter:wght@300;500;700;800&display=swap" rel="stylesheet">
</head>
<body>

<?php
require_once "database.php";

if (isset($_POST["login"])) {
    if (isset($_POST["srcode"]) && isset($_POST["password"])) {
        $srcode = mysqli_real_escape_string($conn, trim($_POST["srcode"]));
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));

        $sql = "SELECT * FROM tbl_student WHERE srcode = '$srcode'";
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
            echo "<div class='alert alert-danger'>Srcode does not match</div>";
        }
    }
}
?>
    <div class="right-section">
        <h2>Sign up</h2>
    </div>

    <div class="StudentLogin">
        <div class="student-text">Student Login</div>

            <form action="studentlogin.php" method="post">

            <div class="Sr-code">Srcode:</div>
            <input class="user" type="text"  name="srcode" placeholder="Srcode" >

            <div class="Password">Password:</div>
            <input class="password" type="password" name="password" placeholder="Password"> </br>

            <input class="Login-Button" type="submit" value="Login" name="login">
            <button class="Cancel-Button" type="button">Exit</button>
            <button class="Create-Button"><a href="studentregistration.php">Create Account</a></button>
    </form>
    </div>
    
</body>
</html>