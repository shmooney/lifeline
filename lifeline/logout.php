<?php
session_start();
session_unset();      // Remove all session variables
session_destroy();    // Destroy the session

// Optional: Clear localStorage via JavaScript
echo "<script>
  localStorage.removeItem('loggedIn');
  window.location.href = 'loginn.php';
</script>";
exit;
?>
