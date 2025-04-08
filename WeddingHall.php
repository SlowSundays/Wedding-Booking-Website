<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!-- Wedding Event Hall Website with a Wedding Theme -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Bliss Event Hall</title>
    <!-- Link to Bootstrap CSS and custom styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
    <style>
    header {
        background-image: url('iamge/images.jpg');
        background-size: cover;
        color: white;
        padding: 50px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
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
        background: linear-gradient(45deg, #ff9a9e, #fad0c4);
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .logout-btn:hover {
        background: linear-gradient(45deg, #fad0c4, #ff9a9e);
        color: black;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .logout-btn:active {
        transform: translateY(1px) scale(1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: linear-gradient(45deg, #f8cdda, #fbc2eb);
    }
    .admin-btn:hover {
        background: linear-gradient(45deg, #fad0c4, #ff9a9e);
        color: black;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .admin-btn:active {
        transform: translateY(1px) scale(1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: linear-gradient(45deg, #f8cdda, #fbc2eb);
    }
    .service-card {
    background: linear-gradient(135deg, #fff, #f8f9fa);
    border: none;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 30px;
    }
    .service-card {
    background: linear-gradient(135deg, #fff, #f8f9fa);
    border: none;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 5px;
    text-align: left;
    height: 100%;
    }
    .service-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .service-card .card-title {
    font-family: 'Roboto', sans-serif;
    font-size: 1.2rem;
    color: #333;
    margin-top: 10px;
    font-weight: 700;
    }
    .service-card .card-text {
    font-size: 0.95rem;
    color: #555;
    margin-top: 10px;
    }
    .service-card i {
    font-size: 3rem;
    margin-bottom: 10px;
    color: #d4a373;
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

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
        <h1 class="text-center py-5">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>        <h2 class="text-center">About Us</h2>
            <p class="text-center">Wedding Bliss Event Hall offers luxurious venues and exclusive wedding packages designed to make your special day unforgettable.</p>
            <div class="text-center">
                <img src="iamge/bg-2.jpg" alt="Wedding Hall" style="width: 400px; height: 300px;" class="img-fluid rounded shadow">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4" style="font-family: 'Great Vibes', cursive; font-size: 2.5rem;">Our Services</h2>
        <div class="row text-center">
            <!-- Venue Decor -->
            <div class="col-md-3 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-brush display-4 mb-3" style="color: #d4a373;"></i>
                        <h5 class="card-title">Venue Decor</h5>
                        <p class="card-text">Elegant and customizable wedding themes.</p>
                    </div>
                </div>
            </div>
            <!-- Catering -->
            <div class="col-md-3 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-egg-fried display-4 mb-3" style="color: #d4a373;"></i>
                        <h5 class="card-title">Catering</h5>
                        <p class="card-text">Exquisite cuisines tailored to your taste.</p>
                    </div>
                </div>
            </div>
            <!-- Photography -->
            <div class="col-md-3 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-camera display-4 mb-3" style="color: #d4a373;"></i>
                        <h5 class="card-title">Photography</h5>
                        <p class="card-text">Capture every precious moment beautifully.</p>
                    </div>
                </div>
            </div>
            <!-- Event Coordination -->
            <div class="col-md-3 mb-4">
                <div class="card service-card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-calendar-event display-4 mb-3" style="color: #d4a373;"></i>
                        <h5 class="card-title">Event Coordination</h5>
                        <p class="card-text">Ensuring a seamless and stress-free wedding day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <p>Email: info@weddingbliss.com</p>
            <p>Phone: +123-456-7890</p>
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
