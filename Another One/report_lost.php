<?php
// Connection to the database (Assuming you have a file named db.php with your database connection code)
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemNumber = $_POST["itemNumber"];
    $itemName = $_POST["itemName"];
    $dateFound = $_POST["dateFound"];

    // Insert the reported lost item into the database
    $query = "INSERT INTO lost_items (item_number, item_name, date_found) VALUES ('$itemNumber', '$itemName', '$dateFound')";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        echo "Lost item reported successfully";
    } else {
        echo "Error reporting lost item: " . mysqli_error($connection);
    }
}
?>
