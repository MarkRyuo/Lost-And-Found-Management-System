<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_nt3102";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Something wend wrong");
}

?>