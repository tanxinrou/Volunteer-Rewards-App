<?php
// Include the database connection script
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve users from the database
$sql = "SELECT UserID, Username, Points, StoreName FROM users"; // Modify this based on your table structure
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <style>
    /* Your CSS Styles here */
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
        <th>Action</th>
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
        echo "<tr><td colspan='6'>No users found</td></tr>";
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
