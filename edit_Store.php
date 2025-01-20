<?php
// Include your database connection
include 'db_connect.php';

// Get the store_id from the URL
$store_id = isset($_GET['store_id']) ? filter_var($_GET['store_id'], FILTER_VALIDATE_INT) : null;

if ($store_id) {
    // Fetch the store details if store_id is available
    $sql = "SELECT * FROM users WHERE StoreID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $store_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $store = $result->fetch_assoc();

    if (!$store) {
        echo "Store not found!";
        exit;
    }
} else {
    echo "Store ID is missing or invalid!";
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
        $sql = "UPDATE users SET StoreName = ?, storeEmail = ?, PasswordHash = ?, StoreAddress = ? WHERE StoreID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $storeName, $storeEmail, $passwordHash, $storeAddress, $store_id);
        $stmt->execute();

        echo "Store updated successfully!";
    }

    // Delete functionality
    if (isset($_POST['delete'])) {
        // SQL query to delete store
        $sql = "DELETE FROM users WHERE StoreID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $store_id);
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .sidebar {
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f4f4f4;
            height: 100%;
            padding-top: 2rem;
        }
        .sidebar a {
            display: block;
            color: #333;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 500px;
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-row {
            margin-bottom: 15px;
        }
        .form-row label {
            display: block;
            margin-bottom: 5px;
        }
        .form-row input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .action-buttons {
            text-align: right;
        }
        .action-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #45a049;
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
                <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this store?');">Delete Store</button>
            </div>
        </div>
    </form>

    <br><br>
    <a href="store_list.php">Back to Store List</a>
</div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
