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
        .navbar {
            background-color: #002060;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            padding: 0 20px;
        }
        .sidebar {
            background-color: #002060;
            width: 150px;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar button {
            background-color: #ffd966;
            border: none;
            padding: 10px;
            width: 100%;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
            color: #002060;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }
        .sidebar a {
            text-decoration: none;
            color: #002060;
        }
        .content {
            margin-left: 170px;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #ffd966;
            color: #002060;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }
        .table th {
            background-color: #003d99;
            color: white;
        }
        .table tr {
            background-color: #003d99;
            color: white;
            border-bottom: 1px solid white;
        }
    </style>
</head>
<body>
<div class="navbar">
    <span>User Management</span>
</div>
<div class="sidebar">
    <button><a href="user_list.html">Users</a></button>
    <button><a href="events_list.html">Events</a></button>
    <button><a href="stores_list.html">Stores</a></button>
    <button><a href="adminDash.html">Dashboard</a></button>
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
</body>
</html>

<?php
$conn->close();
?>
