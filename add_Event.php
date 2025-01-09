<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
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
        .sidebar a {
            text-decoration: none;
            color: #002060;
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
        .form-container input, .form-container select, .form-container button {
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
    </style>
</head>
<body>
<div class="navbar">
  <span>Add User</span>
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
  <div class="header">Add User</div>
  <div class="form-container">
    <form action="#" method="POST">
      <div class="form-row">
        <label for="name">Event ID:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-row">
        <label for="user">Event Details:</label>
        <input type="text" id="user" name="user" required>
      </div>
      <div class="form-row">
        <label for="email">Event Points:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="action-buttons">
        <button class="add">Add User</button>
        <button><a href="events_list.html">Finish</a></button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
