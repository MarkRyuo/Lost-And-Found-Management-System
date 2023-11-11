<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "db_nt3102";

$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Something wend wrong");
}

?>