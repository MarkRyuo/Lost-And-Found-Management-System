  // Automatically hide the success message after 3 seconds
  setTimeout(function() {
    var successMessage = document.querySelector('.success-message');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 3000);