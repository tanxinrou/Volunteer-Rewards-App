<?php
// Include the database connection script
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Add a user if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $storeName = $_POST['StoreName'];
    $email = $_POST['Email'];
    $passwordHash = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash the password
    $storeName = $_POST['StoreName'] ?? null; // If the Store Name is provided
    $storeAddress = $_POST['StoreAddress'] ?? null; // If the Store Address is provided

    // Prepare SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (PasswordHash, Email, StoreName, StoreAddress) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $passwordHash, $storeName, $storeAddress);
    
    // Execute the query and handle success/error
    if ($stmt->execute()) {
        echo "<p>User added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Retrieve users from the database (not being used in this case but might be useful later)
$sql = "SELECT UserID, Username, Points, StoreName FROM users";
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
        <form method="POST">
            <label for="storeID">Store ID:</label>
            <input type="text" id="storeID" name="StoreID" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>
            
            <label for="storeName">Store Name (if applicable):</label>
            <input type="text" id="storeName" name="StoreName">
            
            <label for="storeAddress">Store Address (if applicable):</label>
            <input type="text" id="storeAddress" name="StoreAddress">

            <button type="submit">Add User</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>