<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Register</title>
</head>
<body>
    <?php
    if (isset($_POST["submit"])) {
        $Srcode = $_POST["Srcode"];
        $password = $_POST["password"];

        $errors = array();

        if (empty($Srcode) OR empty($password)) {
            array_push($errors,"All fields are required");
        }
        if (strlen($password)<8) {
            array_push($errors, "Password must be 8 characters long.");
        }
        if (count($errors)>0) {
            foreach ($errors as $errors) {
                echo "<div class = 'alert alert-danger'> $errors</div>";
            }
        }else{
            require_once "database.php";
            $sql = "INSERT INTO tbl_student( Sr_Code, Password) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ss", $Srcode, $password);
                mysqli_stmt_execute($stmt);
                echo "<div class= 'alert alert-success'>You are Registered successfully.</div>";

            }else {
                die("Something went wrong");
            }
        }
    }
    ?>
    <div class="container">
        <form action="StudentRegister.php" method="POST">
            <div id="Sr-code">Sr-code:</div>
            <input type="text" name="Srcode" placeholder="Sr-code">
            <div id="Password">Password:</div>
            <input type="password" name="password" placeholder="Password">

            <button class="Create-Button" value="Register" name="submit">Create Account</button>
        </form>
    </div>
</body>
</html>