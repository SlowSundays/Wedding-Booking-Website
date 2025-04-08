<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
$username = htmlspecialchars($_SESSION['username']);
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Email not provided';
$phone = isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : 'Phone not provided';
$city = isset($_SESSION['city']) ? htmlspecialchars($_SESSION['city']) : 'City not provided';
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Wedding Bliss Event Hall</title>
    <!-- Link to Bootstrap CSS and custom styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
    <style>
    header {
        background-image: url('iamge/bg-2.jpeg');
        background-size: cover;
        color: black;
        padding: 50px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    header h1, header p {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    header nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    header nav ul li {
        display: inline-block;
    }
    header nav ul li a {
        font-size: 1rem;
        text-transform: uppercase;
        font-weight: bold;
        color: black;
        text-decoration: none;
        padding: 10px 15px;
        border: 2px solid transparent;
        border-radius: 5px;
        transition: all 0.3s ease;
        background: linear-gradient(120deg, #d4a373, #f7d6b4);
        color: black;
        font-family: 'Roboto', sans-serif;
    }
    header nav ul li a:hover {
        background: black;
        color: #d4a373;
        border: 2px solid #d4a373;
        transform: scale(1.1);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }
    header nav ul li a:active {
        transform: scale(0.95);
        background: #d4a373;
        color: white;
    }
    .logout-btn {
        font-size: 1rem;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 25px;
        background: linear-gradient(45deg, rgb(215, 72, 32),rgb(216, 17, 23));
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .logout-btn:hover {
        background: linear-gradient(45deg,rgb(215, 72, 32),rgb(216, 17, 23));
        color: black;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .logout-btn:active {
        transform: translateY(1px) scale(1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: linear-gradient(45deg,rgb(215, 72, 32),rgb(216, 17, 23)b);
    }
   
</style>
</head>
<body>
    <!-- Header Section -->
    <header class="text-center py-5">
        <h1>Welcome to Wedding Bliss Event Hall</h1>
        <p class="lead">Your happily-ever-after starts here</p>
        <nav class="mt-3">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="UserProfile.php" class="nav-link text-white">User Profile</a></li>
                <li class="nav-item"><a href="#about" class="nav-link text-white">About Us</a></li>
                <li class="nav-item"><a href="#services" class="nav-link text-white">Services</a></li>
                <li class="nav-item"><a href="BookingPage.html" class="nav-link text-white">Book Now</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link text-white">Contact</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- User Profile Section -->
    <section id="profile" class="py-5">
        <div class="container">
            <div class="profile-card mx-auto" style="max-width: 600px;">
                <h3 class="text-center">User Profile</h3>
                <p class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

                <div class="info">
                    <strong>Email:</strong> <?php echo $email ?>
                </div>
                <div class="info">
                    <strong>Username:</strong> <?php echo $username ?>
                </div>
                <div class="info">
                    <strong>Phone:</strong> <?php echo $phone ?>
                </div>
                <div class="info">
                    <strong>City:</strong> <?php echo $city ?>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="WeddingHall.php" class="btn btn-secondary w-45">Back</a>
                    <a href="editProfile.php" class="btn btn-primary w-45">Edit Profile</a>
                </div>
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
