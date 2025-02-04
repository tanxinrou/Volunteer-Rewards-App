<?php
include 'db_connect.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT couponId, couponTitle, couponDescription, storeId FROM coupon";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupon Management</title>
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
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header input {
            padding: 8px;
            font-size: 14px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .header button {
            background-color: #ffd966;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            text-align: left;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #003d99;
            color: white;
        }
        .edit-btn {
            background-color: #ffd966;
            color: #002060;
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="navbar">
    <span>Coupon Management</span>
</div>
<div class="sidebar">
    <a href="user_list.php">Users</a>
    <a href="events_list.php">Events</a>
    <a href="stores_list.php">Stores</a>
    <a href="adminDash.php">Dashboard</a>
    <a href="coupon_list.php">Coupon</a>
</div>
<div class="content">
    <div class="header">
        <input type="text" placeholder="Search">
        <button><a href="add_Coupon.php" style="color: white; text-decoration: none;">Add Coupon</a></button>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Store ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['storeId']) . "</td>";
                echo "<td>" . htmlspecialchars($row['couponTitle']) . "</td>";
                echo "<td>" . htmlspecialchars($row['couponDescription']) . "</td>";
                echo "<td><a href='edit_Coupon.php?couponId=" . $row['couponId'] . "' class='edit-btn'>Edit Coupon</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No coupons found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
?>

</body>
</html>
