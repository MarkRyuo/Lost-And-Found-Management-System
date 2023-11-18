/*Eto ay simpleng javascript lamang*/

// Code For User
var User = document.getElementById("User");

User.addEventListener("click", function() {
  window.location.href = "/User-Profile/userProfile.html";
});

// code for viewlostItem
var viewlostItem = document.getElementById("viewlostItem");

viewlostItem.addEventListener("click", function() {
  window.location.href = "/View Lost Item/ViewlostItem.html";
});

// code for reportMissing
var reportMissing = document.getElementById("reportMissing");

reportMissing.addEventListener("click", function() {
  window.location.href = "/ReportMissing/ReportMissing.php";
});

// code for claimConformation
var rclaimConformation = document.getElementById("claimConformation");

claimConformation.addEventListener("click", function() {
  window.location.href = "/ClaimConformation/ClaimConformation.html";
});