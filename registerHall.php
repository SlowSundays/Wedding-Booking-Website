<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Processing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fdf2e9;
            margin: 0;
            padding: 0;
            font-family: 'Playfair Display', serif;
            color: #333;
            background-image: url('iamge/bg-8.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        header {
            text-align: center;
            padding: 50px 20px;
        }

        header h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            color: #2c3e50;
            margin: 0;
        }

        .error {
            color: red;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            margin: 20px auto;
        }

        section {
            padding: 60px 20px;
            text-align: center;
        }

        footer {
            background-color: #5a5a5a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 1rem;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
        }

        a:hover {
            opacity: 0.8;
        }

        a.primary {
            background-color: #007bff;
        }

        a.success {
            background-color: #28a745;
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .confirmation {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: center;
        }
        button.primary {
    display: block; /* Ensures the button is treated as a block-level element for centering */
    margin: 20px auto; /* Centers the button horizontally and adds some vertical spacing */
    padding: 10px 20px; /* Adds space inside the button */
    background-color: #007bff; /* Sets a nice blue background */
    color: white; /* Sets the text color to white */
    font-size: 1rem; /* Adjusts the font size */
    border: none; /* Removes the default border */
    border-radius: 5px; /* Rounds the button's corners */
    cursor: pointer; /* Changes the cursor to a pointer on hover */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow for a 3D effect */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions for hover effects */
}

button.primary:hover {
    background-color: #0056b3; /* Darkens the background on hover */
    transform: translateY(-2px); /* Lifts the button slightly on hover */
}

button.primary:active {
    transform: translateY(0); /* Resets the button position on click */
}
    </style>
</head>
<body>
    <header>
        <h1>Booking Processing Page</h1>
    </header>

    <div class="container">
        <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "weddingdb";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
        }

        // Check if the form data is received
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $package = $_POST['package'];

            if (empty($name) || empty($email) || empty($date) || empty($package)) {
                echo "<p class='error'>Error: All fields are required. Please fill out the form completely.</p>";
                echo '<a href="WeddingHall.html" class="primary">Return to Main Form</a>';
                exit();
            }

            $sql = "SELECT email FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo "<p class='error'>Error: Email is not registered. Please use a registered email.</p>";
                echo '<a href="WeddingHall.php" class="primary">Return to Main Form</a>';
                echo '<a href="UserRegister.html" class="success">Register</a>';
                exit();
            }

            $sql = "SELECT * FROM bookings WHERE wedding_date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $date);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p class='error'>Error: Selected date is already in use. Please choose a different date.</p>";
                echo '<a href="BookingPage.html" class="primary">Return to Main Form</a>';
                exit();
            } else {
                $sql = "INSERT INTO bookings (username, email, wedding_date, package) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $name, $email, $date, $package);

                if ($stmt->execute()) {
                    echo "<div class='confirmation'>";
                    echo "<h2>Booking Confirmed!</h2>";
                    echo "<p>Thank you, $name. Your booking for the <strong>$package</strong> package on <strong>$date</strong> has been confirmed. A confirmation email will be sent to <strong>$email</strong>.</p>";
                    echo "</div>";
                    echo '<button onclick="window.location.href=\'WeddingHall.php\'" class="primary">Go Back to Main Page</button>';

                }
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <section class="py-5 bg-light">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Email: info@weddingbliss.com</p>
            <p>Phone: +123-456-7890</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Wedding Bliss Event Hall. All Rights Reserved.</p>
    </footer>
</body>
</html>
