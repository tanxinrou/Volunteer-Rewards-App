<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ga_rewardsapp";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add a user if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userType = $_POST['userType'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $points = isset($_POST['Points']) ? $_POST['Points'] : null;

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (UserType, Username, Email, Password, Points) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $userType, $username, $email, $password, $points);
    if ($stmt->execute()) {
        echo "<p>User added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Retrieve users
$sql = "SELECT UserID, Username, Email, Points FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .navbar, .sidebar, .content, .table, .form-container {
            /* Styles reused from the provided HTML files */
        }
    </style>
</head>
<body>
<div class="navbar">
    <span>User Management</span>
</div>
<div class="sidebar">
    <button><a href="#">Users</a></button>
    <button><a href="#">Events</a></button>
    <button><a href="#">Stores</a></button>
    <button><a href="#">Dashboard</a></button>
    <button><a href="#">Coupon</a></button>
</div>
<div class="content">
    <!-- Form to Add User -->
    <div class="form-container">
        <h2>Add New User</h2>
        <form method="POST">
            <label for="userType">User Type:</label>
            <select id="userType" name="userType" required>
                <option value="Volunteer">Volunteer</option>
                <option value="StoreAdmin">Store Admin</option>
                <option value="SiteAdmin">Site Admin</option>
            </select>
            <label for="username">Username:</label>
            <input type="text" id="username" name="Username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>
            <label for="points">Points:</label>
            <input type="number" id="points" name="Points" min="0">
            <button type="submit">Add User</button>
        </form>
    </div>

    <!-- Display User List -->
    <h2>User List</h2>
    <table border="1" class="table">
        <thead>
        <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Points</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['UserID'] . "</td>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Points'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
