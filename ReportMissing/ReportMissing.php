<?php
session_start();

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

// Initialize the success message variable
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $itemName = $_POST["item_name"];
    $foundDate = $_POST["found_date"];  

    // Insert the new item into the Items table
    $sql = "INSERT INTO Items (ItemName, FoundDate)
            VALUES ('$itemName', '$foundDate')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Item reported successfully!";
        $_SESSION['successMessage'] = $successMessage; // Store in session
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to clear POST data
        exit();
    } else {
        $successMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve success message from session (if set)
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']); // Clear session variable
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css">
    <link rel="stylesheet" href="/ReportMissing/Reportmissing.css">
    <!-- btn Logout Connection -->
    <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
    <!-- btn save connection -->
    <link rel="stylesheet" href="/assets/css/btn-save.css">
    <!-- Add CSS for success message -->
    <link rel="stylesheet" href="/ReportMissing/SuccessMessage.css">
    <title>Report Missing Item | Lost and Found </title>
</head>
<body>

    <aside>
      <!-- Just Wait Here this is navigation but in Left side -->
        <div class="Logo">
          <div class="logo-align">
            <span><img src="/assets/Images/lost-items-missing-svgrepo-com (1).png" alt="This is Image"></span>
            <h1>
              Lost and Found <br> 
              Management <br>System
            </h1>
          </div>
          <p>General</p>
        </div>
  
        <nav class="button-Nav">
          <!-- User Profile -->
        <hr>
        <button class="btn" id="User">
            <span class="btn-text-one"><i class="fa-solid fa-user-shield"></i></span>
            <span class="btn-text-two">User Profile</span>
        </button>
        <hr>
        <!-- View Lost Item -->
        <button class="btn" id="viewlostItem">
          <span class="btn-text-one"><i class="fa-regular fa-eye "></i></span>
          <span class="btn-text-two">View Lost Item</span>
        </button>
        <hr>
        <!--Report Missing-->
        <button class="btn" id="reportMissing">
          <span class="btn-text-one"><i class="fa-solid fa-person-circle-question "></i></span>
          <span class="btn-text-two">Report Missing</span>
        </button>
        <hr>
        <!-- Claim Conformation  -->
        <button class="btn" id="claimConformation">
          <span class="btn-text-one"><i class="fa-solid fa-square-check"></i></span>
          <span class="btn-text-two">Claim Conformation</span>
        </button>
        <hr>
      </aside>
      <!-- End of aside -->

      <main class="parent-Report-Missing">
        <nav class="nav-Report">
          <div class="report-missing">
            <span><i class="fa-solid fa-person-circle-question fa-bounce"></i></span>
            <h1>Report Missing</h1>
          </div>
          <div class="user-button-Log-out">
            <button id="Logout" class="box btn-color-Logout">
              <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
              Logout  <!--This is Text Logout-->
            </button> 
          </div>
        </nav>

        <!-- Display success message -->
        <?php
        if (!empty($successMessage)) {
            echo '<div class="success-message">' . $successMessage . '</div>';
        }
        ?>

        <form method="post" class="report-section" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <!-- <input type="text" placeholder="Item-Number" class="item-number-wsmall" readonly> -->
    
          <div class="subsection-input">
            <input type="text" name="item_name" placeholder="Item-Name" required>
            <input type="date" name="found_date" placeholder="Item-Date" required>
          </div>
    
          <input type="file" name="filename" class="file-upload">
    
          <button class="btn-save" id="Save">
            <div class="icon-wrapper-1">
              <div class="icon-wrapper">
              <i class="fa-solid fa-cloud"></i>
              </div>
            </div>
            <span class="save-text">Save</span>
          </button>
        </form>

      </main>

    
  </body>
  <!-- btn Logout Connection -->
  <script src="/assets/js/Logout.js"></script>
  <!-- btn aside connection -->
  <script src="/assets/Aside-Nav/btn-aside.js"></script>

  <!-- animation  -->
  <script src="/ReportMissing/SuccessMessage.js"></script>
</html>