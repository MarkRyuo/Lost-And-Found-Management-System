    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Login</title>
        <link rel="stylesheet" href="style/StudentLogin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500&family=Inter:wght@300;500;700;800&display=swap" rel="stylesheet">
    </head>
    <body>

    <div class="right-section">
        <h2>Student Sign up</h2>
    </div>

    <?php
            if(isset($_POST["login"])) {
                $Srcode = $_POST["Srcode"];
                $password = $_POST["Password"];
                require_once "database.php";
                $sql = "SELECT * FROM tbl_student WHERE Sr_Code = '$Srcode' ";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["Password"])) {
                        header("Location: StudentDashboard.php");
                        die();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match </div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Sr-code does not match</div>";
            }
        }
    ?>
    <div class="StudentLogin">
        
        <div class="student-text">Student Login</div>
            <form action="StudentLogin.php" method="post">
                <div class="Sr-code">Sr-code:</div>
                <input class="user" type="text" name="Srcode" placeholder="Sr code">

                <div class="Password">Password:</div>
                <input class="password" type="password" name="Password" placeholder="Password">
                
                
            <button class="Login-Button" type="submit" value="Login" name="login">Login</button>
            <button class="Cancel-Button" type="button">Exit</button>
            <button class="Create-Button"><a href="StudentRegister.php">Create Account</a></button>
            </form>
        </div>
        
    </body>
    </html>