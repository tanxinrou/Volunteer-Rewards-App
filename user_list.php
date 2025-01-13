<?php
// Include the database connection script
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve only users from the database, filtering out any non-user data
$sql = "SELECT UserID, Username, Email, Points FROM users"; // Modify this based on your table structure, only retrieving user-related data
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
        .table .edit-btn {
            background-color: #ffd966;
            color: #002060;
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
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
  <div class="header">
    <input type="text" placeholder="Search">
    <button><a href="add_user.php">Add User</a></button>  
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Points</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="userTable">
      <?php
      if ($result->num_rows > 0) {
        // Output user data
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['Username'] . "</td>";
          echo "<td>" . $row['Email'] . "</td>";
          echo "<td>" . $row['Points'] . "</td>";
          echo "<td><button><a href='edit_user.php?UserID=" . $row['UserID'] . "'>Edit User</a></button></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
