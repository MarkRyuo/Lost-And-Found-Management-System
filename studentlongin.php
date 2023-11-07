<?php
    if(isset($_POST["login"])) {
        $Srcode = $_POST["Srcode"];
        $Password = $_POST["Password"];
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE Srcode = '$Srcode' ";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            if (password_verify($Password, $user["Password"])) {
                header("Location: StudentDashboard.php");
                die();
            }
        }else {
            echo "<div class='alert alert-danger'>Password does not match </div>";
        }
        } else {
            echo "<divclass='alert alert-danger'>Sr-code does not match</div>";
    }
?>