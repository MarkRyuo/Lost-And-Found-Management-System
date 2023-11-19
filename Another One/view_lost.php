<?php
// Connection to the database
include 'db.php';

// Retrieve all the lost items
$query = "SELECT * FROM lost_items WHERE date_claimed IS NULL";
$result = mysqli_query($connection, $query);

if ($result) {
    // Display the lost items
    echo "<h2>View Lost Items</h2>";
    echo "<table border='1'>
        <tr>
            <th>Item Number</th>
            <th>Item Name</th>
            <th>Date Found</th>
            <th>Claim</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . $row['item_number'] . "</td>
            <td>" . $row['item_name'] . "</td>
            <td>" . $row['date_found'] . "</td>
            <td><button onclick='claimItem(" . $row['id'] . ")'>Claim</button></td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Error retrieving lost items: " . mysqli_error($connection);
}
?>
