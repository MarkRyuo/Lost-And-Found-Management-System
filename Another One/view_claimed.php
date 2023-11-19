<?php
// Connection to the database
include 'db.php';

// Retrieve all the claimed items
$query = "SELECT * FROM lost_items WHERE date_claimed IS NOT NULL";
$result = mysqli_query($connection, $query);

if ($result) {
    // Display the claimed items
    echo "<h2>View Claimed Items</h2>";
    echo "<table border='1'>
        <tr>
            <th>Item Number</th>
            <th>Item Name</th>
            <th>Date Found</th>
            <th>Date Claimed</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . $row['item_number'] . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['date_found'] . "</td>
            <td>" . $row['date_claimed'] . "</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Error retrieving claimed items: " . mysqli_error($connection);
}
?>
