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
        .sidebar a:hover {
            background-color: #f0c040;
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
        .form-container input, .form-container button {
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
    <a href="coupon_list.html">Coupon</a>
</div>
<div class="content">
    <div class="header">Edit User Profile</div>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'fyp');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted for update or delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $username = $_POST['username'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $points = $_POST['points'];

            $updateSql = "UPDATE users SET name = ?, email = ?, points = ? WHERE username = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ssis", $name, $email, $points, $username);

            if ($stmt->execute()) {
                echo "<p>User updated successfully.</p>";
            } else {
                echo "<p>Error updating user: " . $conn->error . "</p>";
            }

            $stmt->close();
        } elseif (isset($_POST['delete'])) {
            $username = $_POST['username'];

            $deleteSql = "DELETE FROM users WHERE username = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                echo "<p>User deleted successfully.</p>";
                echo '<a href="user_list.php">Back to User List</a>';
                $stmt->close();
                $conn->close();
                exit;
            } else {
                echo "<p>Error deleting user: " . $conn->error . "</p>";
            }

            $stmt->close();
        }
    }

    if (isset($_GET['username'])) {
        $username = $_GET['username'];

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    ?>
        <div class="form-container">
            <form method="POST" action="edit_user.php">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                <div class="form-row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-row">
                    <label for="points">Points:</label>
                    <input type="number" id="points" name="points" value="<?php echo $user['points']; ?>" required>
                </div>
                <div class="action-buttons">
                    <button type="submit" name="update">Update User</button>
                </div>
            </form>

            <form method="POST" action="edit_user.php" onsubmit="return confirm('Are you sure you want to delete this user?')">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                <button type="submit" name="delete">Delete User</button>
            </form>
        </div>
    <?php
        } else {
            echo "<p>User not found.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Invalid username.</p>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>