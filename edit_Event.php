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
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #description {
            width: 267%;
        }
        #pointsRewarded {
            width: 55%;
        }
        #activitiesDate {
            width: 80%;
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

    // Get event ID from URL
    $eventID = $_GET['ActivitiesID'];
    
    // Fetch event data
    $sql = "SELECT * FROM activities WHERE ActivitiesID = $eventID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>

    <div class="form-container">
        <form method="POST" action="edit_Event.php">
            <div class="form-row">
                <span><label for="name">Name:</label>
                <?php echo htmlspecialchars($row['ActivitiesName']); ?></span>
            </div>

            <div class="form-row">
                <span><label for="description">Description:</label>
                <input type="text" id="description" name="Description" value="<?php echo htmlspecialchars($row['Description']); ?>" required></span>
            </div>

            <div class="form-row">
                <span><label for="description">Points Reward:</label><br>
                <input type="number" id="pointsRewarded" name="PointsRewarded" value="<?php echo htmlspecialchars($row['PointsRewarded']); ?>" required></span>
            </div>

            <div class="form-row">
                <span><label for="activitiesDate">Date:</label><br>
                <input type="date" id="activitiesDate" name="ActivitiesDate" value="<?php echo htmlspecialchars($row['ActivitiesDate']); ?>" required></span>
            </div>

            <div class="action-buttons">
                <button type="submit" name="updateEvent">Update Event</button>
            </div>
        </form>

        <div class="action-buttons">
            <form method="POST" action="edit_Event.php" onsubmit="return confirm('Are you sure you want to delete this event?')">
                <input type="hidden" name="activitiesID" value="<?php echo htmlspecialchars($eventID); ?>">
                <button type="submit" name="deleteEvent">Delete Event</button>
            </form>
        </div>
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