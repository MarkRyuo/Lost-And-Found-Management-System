// JavaScript for AJAX requests

// Function to report a lost item
function reportLost() {
  var itemNumber = document.getElementById("itemNumber").value;
  var itemName = document.getElementById("itemName").value;
  var dateFound = document.getElementById("dateFound").value;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          // Refresh the view after reporting
          viewLostItems();
      }
  };

  xhr.open("POST", "report_lost.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("itemNumber=" + itemNumber + "&itemName=" + itemName + "&dateFound=" + dateFound);
}

// Function to view lost items
function viewLostItems() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("viewLost").innerHTML = this.responseText;
      }
  };

  xhr.open("GET", "view_lost.php", true);
  xhr.send();
}

// Function to claim an item
function claimItem(itemId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          // Refresh the view after claiming
          viewLostItems();
          viewClaimedItems();
      }
  };

  xhr.open("GET", "claim_item.php?id=" + itemId, true);
  xhr.send();
}

// Function to view claimed items
function viewClaimedItems() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("claimedItems").innerHTML = this.responseText;
      }
  };

  xhr.open("GET", "view_claimed.php", true);
  xhr.send();
}

// Initial view when the page loads
viewLostItems();
viewClaimedItems();
