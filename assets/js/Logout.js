/*Dapat dito ay may condition hindi pa ako maalam
kasi kailangan may alert*/

// View-lost-Logout

var Logout = document.getElementById("Logout");

Logout.addEventListener("click", function() {
  // Display alert
  var confirmLogout = confirm("Are you sure you want to log out?");
  
  // If the user confirms, redirect to "/index.html"
  if (confirmLogout) {
    window.location.href = "/index.html";
  }
});
