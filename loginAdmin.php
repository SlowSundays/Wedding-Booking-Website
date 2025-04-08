<?php
session_start();

// Include database configuration

$conn = new mysqli('localhost', 'root', '', 'weddingdb');

// Check connection
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Sorry, we're experiencing technical issues.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Matches the 'name' attribute in the form
    $password = $_POST['password']; // Matches the 'name' attribute in the form

    // Check for empty inputs
    if (empty($username) || empty($password)) {
        header("Location: login.html?error=empty_fields");
        exit();
    }

    // Query to fetch the user by username
    $sql = "SELECT * FROM adminlogin WHERE adminusername = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("SQL prepare failed: " . $conn->error);
        die("Sorry, we're experiencing technical issues.");
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['adminpassword'])) {
            // Store session data
            $_SESSION['adminusername'] = $username;
            $_SESSION['email'] = $user['email']; // Store email in the session

            // Redirect to the main page
            header("Location: AdminDashboard.php");
            exit();
        } else {
            // Redirect to login page with error message
            header("Location: loginAdmin.html?error=incorrect_password");
            exit();
        }
    } else {
        // Redirect to login page with error message
        header("Location: login.html?error=user_not_found");
        exit();
    }
}
?>
