<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home.php"); // Logged in → go to homepage
} else {
    header("Location: sign upp.php"); // Not logged in → go to signup page
}
exit();
?>
