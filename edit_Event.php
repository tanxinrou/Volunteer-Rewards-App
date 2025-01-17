<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
    <span>Edit Event</span>
    <div class="menu-icon">≡</div>
</div>
<div class="sidebar">
    <a href="user_list.php">Users</a>
    <a href="events_list.php">Events</a>
    <a href="stores_list.php">Stores</a>
    <a href="adminDash.php">Dashboard</a>
    <a href="coupon_list.php">Coupon</a>
</div>
<div class="content">
    <div class="header">Edit Event</div>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'fyp');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user ID from URL
    $eventID = $_GET['ActivitiesID'];
    
    // Fetch user data
    $sql = "SELECT * FROM activities WHERE ActivitiesID = $eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>

    <div class="form-container">
        <div class="form-row">
            <span>Name: <?php echo htmlspecialchars($row['ActivitiesName']); ?></span>
        </div>    
    <div class="form-row">
            <span>Description:<br>
            <?php echo htmlspecialchars($row['Description']); ?></span>
            <button><a href="edit_Event.php?ActivitiesID=<?php echo $eventID; ?>">Edit</a></button>
        </div>
        <div class="form-row">
            <span>Points Reward: <?php echo htmlspecialchars($row['PointsRewarded']); ?></span>
            <button><a href="edit_Event.php?ActivitiesID=<?php echo $eventID; ?>">Edit</a></button>
        </div>
        <div class="form-row">
            <span>Date: <?php echo htmlspecialchars($row['ActivitiesDate']); ?></span>
            <button><a href="edit_Event.php?ActivitiesID=<?php echo $eventID; ?>">Edit</a></button>
        </div>
    </div>

    <div class="action-buttons">
        <button class="delete-btn">
            <a href="delete_Event.php?id=<?php echo $eventID; ?>" style="color: white;">Delete Event</a>
        </button>
        <button>
            <a href="events_list.php" style="color: white;">Finish</a>
        </button>
    </div>

    <?php
    } else {
        echo "<p style='text-align: center;'>Event not found.</p>";
    }

    $conn->close();
    ?>

</div>
</body>
</html>