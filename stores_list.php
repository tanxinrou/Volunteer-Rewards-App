<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store Management</title>
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
  <span>Store Management</span>
  <div class="menu-icon">≡</div>
</div>
<div class="sidebar">
  <a href="user_list.php">Users</a>
  <a href="events_list.php">Events</a>
  <a href="stores_list.php">Stores</a>
  <a href="adminDash.php">Dashboard</a>
  <a href="coupon_list.html">Coupon</a>
</div>
<div class="content">
  <div class="header">
    <input type="text" placeholder="Search">
    <button><a href="add_Store.php" style="color: white; text-decoration: none;">Add Store</a></button>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Store Name</th>
        <th>Store Email</th>
        <th>Store Address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'fyp');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch stores from the database
        $sql = "SELECT StoreName, StoreEmail, StoreAddress FROM users WHERE StoreName IS NOT NULL";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each row of store data
            while ($row = $result->fetch_assoc()) {
                $storeName = !empty($row['StoreName']) ? htmlspecialchars($row['StoreName']) : 'N/A';
                $storeEmail = !empty($row['StoreEmail']) ? htmlspecialchars($row['StoreEmail']) : 'N/A';
                $storeAddress = !empty($row['StoreAddress']) ? htmlspecialchars($row['StoreAddress']) : 'N/A';

                echo "<tr>
                        <td>" . $storeName . "</td>
                        <td>" . $storeEmail . "</td>
                        <td>" . $storeAddress . "</td>
                        <td><button class='edit-btn'><a href='edit_store.php?store_name=" . urlencode($row['StoreName']) . "' style='color: white; text-decoration: none;'>Edit</a></button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No stores found.</td></tr>";
        }

        $conn->close();
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
