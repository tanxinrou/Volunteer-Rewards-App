<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store Profile</title>
    <style>
        /* Your CSS styles here */
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

    <?php
    $conn = new mysqli('localhost', 'root', '', 'store_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $storeId = $_GET['id'];
    $sql = "SELECT * FROM stores WHERE id = $storeId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $store = $result->fetch_assoc();
    ?>
        <div class="form-container">
            <form method="POST" action="update_store.php">
                <input type="hidden" name="id" value="<?php echo $store['id']; ?>">
                <div class="form-row">
                    <label for="store_name">Store Name:</label>
                    <input type="text" id="store_name" name="store_name" value="<?php echo htmlspecialchars($store['store_name']); ?>">
                </div>
                <div class="form-row">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($store['username']); ?>">
                </div>
                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($store['email']); ?>">
                </div>
                <div class="form-row">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($store['password']); ?>">
                </div>
                <div class="action-buttons">
                    <button type="submit">Update Store</button>
                </div>
            </form>
        </div>
    <?php
    } else {
        echo "<p>Store not found.</p>";
    }
    $conn->close();
    ?>
</div>
</body>
</html>
