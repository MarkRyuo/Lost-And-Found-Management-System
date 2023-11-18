<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve lost items from the Items table
$sql = "SELECT * FROM Items ";
$result = $conn->query($sql);

?>

<!-- HTML HERE -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">
  <!-- This is link for aside -->
  <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css">
  <link rel="stylesheet" href="/View Lost Item/ViewLostItem.css">

  <!-- btn Logout connection -->
  <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
  <link rel="stylesheet" href="/View Lost Item/View.css">
  <title>View Lost Item|Lost and Found</title>
</head>
<body>

    <!-- This Aside -->
      <!-- End of aside -->
      
   <main class="Tables">
          <!-- Header Section -->
     <header class="nav">
      <nav class="parent-Nav">
        <h1><span><i class="fa-solid fa-eye fa-beat-fade"></i></span>View Lost Item</h1>
        <div class="user-button-Log-out">
          <button id="Logout" class="box btn-color-Logout">
            <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
            Logout  <!--This is Text Logout-->
          </button> 
        </div>
      </nav>
    </header>
    
      <!-- Table Here -->
      <?php
// Display lost items
if ($result->num_rows > 0) {
    
    echo "<table class='parent-Table'>";
    echo "<tr class='table-Header'>";
    echo "<th>Item ID</th>";
    echo "<th>Item Name</th>";
    echo "<th>Found Date</th>";
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='table-Data'>";
        echo "<td><input type='text' value='" . $row["ItemID"] . "' readonly></td>";
        echo "<td><input type='text' value='" . $row["ItemName"] . "' readonly></td>";
        echo "<td><input type='text' value='" . $row["FoundDate"] . "' readonly></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No lost items found.";
}

// Close the database connection
$conn->close();
?>

  </main>
</body>
  <!-- connection in aside js -->
  <script src="/assets/Aside-Nav/btn-aside.js"></script>

  <script src="/assets/js/Logout.js"></script>
</html>