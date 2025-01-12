<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
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
    <span>Event Management</span>
    <div class="menu-icon">≡</div>
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
        <button><a href="add_Event.php">Add Event</a></button>  </div>
    <table class="table">
        <thead>
        <tr>
            <th>Event ID:</th>
            <th>Event Details:</th>
            <th>Event Points:</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>44356</td>
            <td>21</td>
            <td>35</td>
            <td><button><a href="edit_Event.php">Edit Event</a></button></td>
        </tr>
        <tr>
            <td>22154</td>
            <td>21</td>
            <td>15</td>
            <td><button><a href="edit_Event.php">Edit Event</a></button></td>
        </tr>
        <tr>
            <td>66548</td>
            <td>21</td>
            <td>25</td>
            <td><button><a href="edit_Event.php">Edit Event</a></button></td>
        </tr>
        <tr>
            <td>11547</td>
            <td>21</td>
            <td>40</td>
            <td><button><a href="edit_Event.php">Edit Event</a></button></td>
        </tr>
        <tr>
            <td>33657</td>
            <td>21</td>
            <td>40</td>
            <td><button><a href="edit_Event.php">Edit Event</a></button></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>