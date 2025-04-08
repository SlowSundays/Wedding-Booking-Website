<?php
session_start();

$host = "localhost";    // Database host (e.g., localhost)
$username = "root";     // Database username
$password = "";         // Database password
$database = "weddingdb";  // Name of your database

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);


// Check if the admin is logged in
if (!isset($_SESSION['adminusername'])) {
    header('Location: loginAdmin.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: loginAdmin.html');
    exit();
}

if (isset($_GET['delete_participant'])) {
    $participant_id = $_GET['delete_participant'];

    // Prepare and execute the delete query
    $delete_query = "DELETE FROM bookings WHERE id = ?";
    $delete_query2 = "DELETE FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $participant_id);
        $stmt->execute();
        $stmt->close();

        if ($stmt2 = $conn->prepare($delete_query2)) {
            $stmt2->bind_param("i", $participant_id);
            $stmt2->execute();
            $stmt2->close();
        } else {
            die("Error deleting from another table: " . $conn->error);
        }
        // Redirect to the same page after deletion
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        die("Error deleting participant: " . $conn->error);
    }
}

$participants_query = "SELECT id, username, wedding_date, package, email FROM bookings";
$participants = $conn->query($participants_query);
if (!$participants) {
    die("Error fetching participants: " . $conn->error);
}

// Fetch categories
$packages_query = "
    SELECT b.package, GROUP_CONCAT(b.username SEPARATOR ', ') AS usernames, COUNT(*) AS user_count
    FROM bookings b
    LEFT JOIN users u ON b.id = u.id
    GROUP BY b.package
    ORDER BY user_count DESC
";
$packages = $conn->query($packages_query);
if (!$packages) {
    die("Error fetching package details: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('iamge/bg-1.jpg');
            color: #333;
        }
        header {
            background-image: url('iamge/images.jpeg');
            color: white;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        nav {
            text-align: center;
            margin: 20px 0;
        }
        nav a {
            color: white;
            background-color: #e74c3c;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        nav a:hover {
            background-color: #c0392b;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 5px;
            color: #2c3e50;
        }
        form {
            margin-bottom: 30px;
        }
        form input, form textarea, form button {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        form button {
            background-color: #2c3e50;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #34495e;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f4f4f4;
        color: #333;
    }

    table tr {
        background-color: #ffffff; /* Set white background for all rows */
    }

    table tr:nth-child(even) {
        background-color: #ffffff; /* Ensure alternate rows are also white */
    }

    table tr:hover {
        background-color: #f9f9f9
    }
        a.action {
            color: #e74c3c;
            text-decoration: none;
        }
        a.action:hover {
            text-decoration: underline;
        }
        
        

    </style>
    ><script>function filterParticipants() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#participantsTable tbody tr');

            if (!rows) return;

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (name.includes(searchInput) || email.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function confirmDeletion(event) {
            if (!confirm('Are you sure you want to delete this participant?')) {
                event.preventDefault();
            }
        }</script>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['adminusername'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <nav>
            <a href="?logout=1">Logout</a>
        </nav>
    </header>


    <h2>Search Participants</h2>
<div class="search-bar">
    <input type="text" id="searchInput" onkeyup="filterParticipants()" placeholder="Search by name or email...">
</div>

<h2>Participants</h2>
<table id="participantsTable">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Wedding Date</th>
        <th>Package</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $participants->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['wedding_date']; ?></td>
            <td><?php echo $row['package']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><a href="?delete_participant=<?php echo $row['id']; ?>" class="action">Delete</a></td>
        </tr>
    <?php } ?>
</table>

<script>
    function filterParticipants() {
        // Get input value and convert to uppercase
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('participantsTable');
        const rows = table.getElementsByTagName('tr');
        
        // Loop through table rows (skipping the header row)
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            
            // Check each cell in the row
            for (let j = 0; j < cells.length - 1; j++) { // Exclude the action column
                if (cells[j]) {
                    const text = cells[j].textContent || cells[j].innerText;
                    if (text.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            
            // Show or hide the row based on match
            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>


        <h2>Categories</h2>
        <table id="packagesTable">
    <tr>
        <th>Package</th>
        <th>Names</th>
        <th>Total</th>
    </tr>
    <?php while ($row = $packages->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['package']; ?></td>
            <td><?php echo $row['usernames']; ?></td>
            <td><?php echo $row['user_count']; ?></td>
        </tr>
    <?php } ?>
</table>
    </div>
</body>
</html>
