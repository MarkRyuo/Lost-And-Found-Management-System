<?php
require_once "database.php";

// Handle login submission
if (isset($_POST["login"])) {
    if (isset($_POST["srcode"]) && isset($_POST["password"])) {
        $srcode = mysqli_real_escape_string($conn, trim($_POST["srcode"]));
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));

        $sql = "SELECT * FROM tb_studentlogin WHERE srcode = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $srcode);
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
                echo "<div class='alert alert-danger'>Srcode does not match</div>";
            }

            mysqli_stmt_close($stmt);
        } else {
            die("Preparing the statement failed: " . mysqli_error($conn));
        }
    }
}
?>