<?php
// Include the database connection script
include 'db_connect.php';

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
        /* Your CSS Styles */
    </style>
</head>
<body>
<div class="navbar">
    <span>User Management</span>
</div>
<div class="sidebar">
    <button><a href="user_list.php">Users</a></button>
    <button><a href="events_list.php">Events</a></button>
    <button><a href="stores_list.php">Stores</a></button>
    <button><a href="adminDash.php">Dashboard</a></button>
    <button><a href="coupon_list.html">Coupon</a></button>
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
</div>
</body>
</html>

<?php
$conn->close();
?>
