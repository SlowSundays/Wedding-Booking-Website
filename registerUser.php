<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fdf2e9;
            margin: 50px;
            padding: 20px;
            height: 100vh;
            background-image: url('iamge/bg-1.jpeg'); /* Inline background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        header h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            text-align: center;
        }

        .error {
            color: red;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
        }

        .success {
            color: green;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
        }

        section {
            padding: 60px 0;
        }

        footer {
            background-color: #5a5a5a;
            color: white;
        }

        footer p {
            margin: 0;
            font-size: 25px;
        }

        .return-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
            display: block;
            width: fit-content;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <header class="text-center py-5">
        <h1>Booking Processing Page</h1>
    </header>
    <?php
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

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "<p class='error'>Passwords do not match. Please try again.</p>";
            echo '<a href="UserRegister.html" class="return-button">Back To Form</a>';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists
            $sql = "SELECT id FROM users WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p class='error'>Email is already registered. Please use a different email.</p>";
                echo '<a href="login.html" class="return-button">Proceed To Login</a>';
            } else {
                // Insert new user
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
                if ($conn->query($sql) === TRUE) {
                    echo "<p class='success'>Registration successful! You can now <a href='login.html'>login</a>.</p>";
                } else {
                    echo "<p class='error'>Error: " . $conn->error . "</p>";
                }
            }
        }
    }

    $conn->close();
    ?>
</body>
</html>
