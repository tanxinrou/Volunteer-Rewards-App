<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fyp');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle update and delete actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    if (isset($_POST['update'])) {
        $name = $_POST['name'];  // User's name in the form
        $email = $_POST['email'];
        $points = $_POST['points'];

        // Update query (adjusting column names based on the actual ones in your DB)
        // Assuming 'Username' is correct as the name field
        $updateSql = "UPDATE users SET Username = ?, Email = ?, Points = ? WHERE Username = ?";
        $stmt = $conn->prepare($updateSql);
        // Adjusting bind_param types
        $stmt->bind_param("ssis", $name, $email, $points, $username);  

        if ($stmt->execute()) {
            // Redirect to user list after successful update
            header("Location: user_list.php");
            exit();  // Don't forget to call exit after header redirection
        } else {
            echo "<p>Error updating user: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $deleteSql = "DELETE FROM users WHERE Username = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            echo "<p>User deleted successfully.</p>";
            echo '<a href="user_list.php">Back to User List</a>';
            $stmt->close();
            $conn->close();
            exit;
        } else {
            echo "<p>Error deleting user: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

// Fetch user details if username is provided
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "SELECT * FROM users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = $user['Username'];  // Assuming 'Username' is the name field
        $email = $user['Email'];
        $points = $user['Points'];
    } else {
        echo "<p style='color: red;'>User not found. Please check the username.</p>";
    }
    $stmt->close();
} else {
    echo "<p style='color: red;'>Invalid request. Username not provided.</p>";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
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
        .menu-icon {
            width: 30px;
            height: 30px;
            background-color: #003d99;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
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
            text-decoration: none;
            padding: 10px;
            color: #002060;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 0 5px 5px 0;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #e6c557;
        }
        .content {
            margin-left: 170px;
            padding: 20px;
        }
        .header {
            font-size: 18px;
            font-weight: bold;
            background-color: #003d99;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
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
        .form-row span {
            font-size: 14px;
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
        <span>Edit User Profile</span>
    </div>
    
<div class="sidebar">
    <a href="user_list.php">Users</a>
    <a href="events_list.php">Events</a>
    <a href="stores_list.php">Stores</a>
    <a href="adminDash.php">Dashboard</a>
    <a href="coupon_list.php">Coupon</a>
</div>
    <div class="content">
        <div class="header">Edit User Profile</div>

        <?php if (isset($user)): ?>
            <div class="form-container">
                <form method="POST" action="edit_User.php">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    
                    <!-- Name field -->
                    <div class="form-row">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    
                    <!-- Email field -->
                    <div class="form-row">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    
                    <!-- Points field -->
                    <div class="form-row">
                        <label for="points">Points:</label>
                        <input type="number" id="points" name="points" value="<?php echo htmlspecialchars($points); ?>" required>
                    </div>

                    <!-- Update button -->
                    <div class="action-buttons">
                        <button type="submit" name="update">Update User</button>
                    </div>
                </form>

                <!-- Delete form -->
                <form method="POST" action="edit_User.php" onsubmit="return confirm('Are you sure you want to delete this user?')">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <button type="submit" name="delete">Delete User</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
