<?php
// Connection to the database
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $itemId = $_GET["id"];

    // Update the date_claimed field for the claimed item
    $query = "UPDATE lost_items SET date_claimed = CURRENT_DATE() WHERE id = $itemId";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        echo "Item claimed successfully";
    } else {
        echo "Error claiming item: " . mysqli_error($connection);
    }
}
?>
