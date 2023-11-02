<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sr_code = $_POST["sr_code"];
    $password = $_POST["password"];
    
    // You can add your login validation logic here.
    // For example, checking if the username and password are correct.
    
    if ($sr_code === "student" && $password === "password") {
        // Successful login, you can redirect to another page.
        header("Location: index.html");
        exit();
    } else {
        // Failed login, you can display an error message or redirect back to the login page.
        header("Location: StudentLogin.html");
        exit();
    }
}
?>
