<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <style>
        /* Your CSS styles here */
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

    <?php
    $conn = new mysqli('localhost', 'root', '', 'store_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    ?>
        <div class="form-container">
            <form method="POST" action="update_user.php">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="form-row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                </div>
                <div class="form-row">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>">
                </div>
                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-row">
                    <label for="points">Points:</label>
                    <input type="number" id="points" name="points" value="<?php echo htmlspecialchars($user['points']); ?>">
                </div>
                <div class="action-buttons">
                    <button type="submit">Update User</button>
                </div>
            </form>
        </div>
    <?php
    } else {
        echo "<p>User not found.</p>";
    }
    $conn->close();
    ?>
</div>
</body>
</html>
