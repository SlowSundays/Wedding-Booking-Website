<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the main page
header("Location: MainPage.html");
exit();
?>
