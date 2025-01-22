<?php
// Include your database connection
include 'db_connect.php';

// Get the store_name from the URL
$store_name = isset($_GET['store_name']) ? filter_var($_GET['store_name'], FILTER_SANITIZE_STRING) : null;

if ($store_name) {
    // Fetch the store details if store_name is available
    $sql = "SELECT * FROM users WHERE StoreName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $store_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $store = $result->fetch_assoc();

    if (!$store) {
        echo "Store not found!";
        exit;
    }
} else {
    echo "Store name is missing or invalid!";
    exit;
}

// Check if form is submitted for update or delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update functionality
    if (isset($_POST['store_name'], $_POST['storeEmail'], $_POST['password'], $_POST['storeAddress'])) {
        $storeName = $_POST['store_name'];
        $storeEmail = $_POST['storeEmail'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $storeAddress = $_POST['storeAddress'];

        // SQL query to update store details
        $sql = "UPDATE users SET StoreName = ?, storeEmail = ?, PasswordHash = ?, StoreAddress = ? WHERE StoreName = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $storeName, $storeEmail, $passwordHash, $storeAddress, $store_name);
        $stmt->execute();

        echo "Store updated successfully!";
    }

    // Delete functionality
    if (isset($_POST['delete'])) {
        // SQL query to delete store
        $sql = "DELETE FROM users WHERE StoreName = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $store_name);
        $stmt->execute();

        echo "Store deleted successfully!";
        // Redirect to another page after deletion (optional)
        header('Location: stores_list.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store Profile</title>
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
            padding: 0 20px;
            color: white;
        }
        .sidebar {
            background-color: #002060;
            width: 150px;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            display: block;
            background-color: #ffd966;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #002060;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 0 5px 5px 0;
        }
        .content {
            margin-left: 170px;
            padding: 20px;
        }
        .form-container {
            background-color: #003d99;
            color: white;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            margin: auto;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-row button {
            background-color: #ffd966;
            color: #002060;
            border: none;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
            cursor: pointer;
        }
        .action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .action-buttons button {
            background-color: #ffd966;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .action-buttons .delete-btn {
            background-color: red;
        }
    </style>
</head>
<body>
<div class="navbar">
    <span>Edit Store Profile</span>
</div>
<div class="sidebar">
    <a href="user_list.php">Users</a>
    <a href="events_list.php">Events</a>
    <a href="stores_list.php">Stores</a>
    <a href="adminDash.php">Dashboard</a>
    <a href="coupon_list.php">Coupon</a>
</div>
<div class="content">
    <div class="header">Edit Store Profile</div>

    <form method="POST">
    <div class="form-container">
        <div class="form-row">
            <label for="store_name">Store Name:</label>
            <input type="text" name="store_name" value="<?php echo htmlspecialchars($store['StoreName']); ?>" required>
        </div>

        <div class="form-row">
            <label for="storeEmail">Store Email:</label>
            <input type="email" name="storeEmail" value="<?php echo htmlspecialchars($store['storeEmail']); ?>" required>
        </div>

        <div class="form-row">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter new password" required>
        </div>

        <div class="form-row">
            <label for="storeAddress">Store Address:</label>
            <input type="text" name="storeAddress" value="<?php echo htmlspecialchars($store['StoreAddress']); ?>" required>
        </div>

        <div class="action-buttons">
            <button type="submit">Update Store</button>
            <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete this store?');">Delete Store</button>
        </div>
    </div>
</form>

    <br><br>
    <a href="stores_list.php">Back to Store List</a>
</div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
