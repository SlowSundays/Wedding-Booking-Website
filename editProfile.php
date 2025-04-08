<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weddingdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated user information from the form
    $newUsername = $conn->real_escape_string($_POST['username']);
    $newPhone = $conn->real_escape_string($_POST['phone']);
    $newCity = $conn->real_escape_string($_POST['city']);
    $userId = $_SESSION['id'];  // Assuming userId is stored in session

    // Update user information in the database
    $sql = "UPDATE users SET username = '$newUsername', phone = '$newPhone', city = '$newCity' WHERE id = '$userId'";

    // Check if query executes successfully
    if ($conn->query($sql) === TRUE) {
        // Update session data
        $_SESSION['username'] = $newUsername;
        $_SESSION['phone'] = $newPhone;
        $_SESSION['city'] = $newCity;
        echo "<p class='success'>Profile updated successfully!</p>";
    } else {
        echo "<p class='error'>Error updating profile: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Wedding Bliss Event Hall</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <!-- Header Section -->
    <header class="text-center py-5">
        <h1>Edit Your Profile</h1>
        <p class="lead">Make changes to your profile information below</p>
    </header>

    <!-- Edit Profile Form -->
    <section class="py-5">
        <div class="container">
            <div class="edit-profile-card mx-auto" style="max-width: 600px;">
                <h3 class="text-center">Edit Profile</h3>
                <form method="POST" action="editProfile.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($_SESSION['city']); ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="UserProfile.php" class="btn btn-secondary w-45">Back</a>
                        <button type="submit" class="btn btn-primary w-45">Update Profile</button>
                    </div> 
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; 2024 Wedding Bliss Event Hall. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
