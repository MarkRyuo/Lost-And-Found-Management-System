<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST["submit"])) {
            $srcode = $_POST["srcode"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatpassword = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($srcode) OR empty($email) OR empty($password) OR empty($repeatpassword)) {
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
            $sql = "SELECT * FROM tbl_student WHERE emailaddress = '$email'";
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

                $sql = "INSERT INTO tbl_student (srcode, emailaddress, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $srcode, $email, $passwordHash);

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
    <form action="studentregistration.php" method="post">
        <div>Sr Code:</div>
        <input type="text" name="srcode" placeholder="Sr code">
        <div>Email Address:</div>
        <input type="email" name="email" placeholder="Email Address">
        <div>Password:</div>
        <input type="password" name="password" placeholder="Password">
        <div>Repeat Password:</div>
        <input type="password" name="repeat_password" placeholder="Repeat Password"> </br>
        <input type="submit" value="Register" name="submit">
    </form>
</body>
</html>