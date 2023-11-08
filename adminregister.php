<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
    <link rel="stylesheet" href="style/studentregister.css">
    <link rel="stylesheet" href="studentlogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500&family=Inter:wght@300;500;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        if (isset($_POST["submit"])) {

            $admin = $_POST["admin"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatpassword = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($admin) OR empty($email) OR empty($password) OR empty($repeatpassword)) {
                array_push($errors, "All fields are required.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "This email is not valid");
            }
            if (strlen($password) < 5) {
                array_push($errors, "Password must be atleast 5 characters long");
            }
            if ($password!==$repeatpassword) {
                array_push($errors, "This password does not match");
            }
            
            require_once "database.php";
            $sql = "SELECT * FROM tbl_admin WHERE emailaddress = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already Exist");
            }

            if (count($errors) > 0 ) {
                foreach ($errors as $errors) {
                    echo "<div class='alert alert-danger'>$errors</div>";
                }
            }
            else{

                $sql = "INSERT INTO tbl_admin (admin, emailaddress, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $admin, $email, $passwordHash);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>You are registered successfully!</div>";
                    } else {
                        die("Execution of the prepared statement failed: " . mysqli_stmt_error($stmt));
                    }
                } else {
                    die("Preparing the statement failed: " . mysqli_stmt_error($stmt));
                }
            }
        }
    ?>

        <div class="right-section">
            <h2>Sign in</h2>
        </div>

    <div class="container">

        <div class="student-register">Admin Register</div>

        <form action="adminregister.php" method="post">

            <div class="Sr-code">Admin Username:</div>
            <input class="user" type="text" name="admin" placeholder="Admin Username">

            <div class="Sr-code">Email Address:</div>
            <input class="user" type="email" name="email" placeholder="Email Address">

            <div class="Sr-code">Password:</div>
            <input class="user" type="password" name="password" placeholder="Password">

            <div class="Sr-code">Repeat Password:</div>
            <input class="user" type="password" name="repeat_password" placeholder="Repeat Password"> </br>

            <input class="button-register" type="submit" value="Register" name="submit">

            <button class="Create-Button"><a href="securitylogin.php">Sign in</a></button>
        </form>
    </div>
    
</body>
</html>