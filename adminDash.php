<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .stats-card {
            background-color: #003d99;
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .stats-item {
            text-align: center;
        }
        .stats-item h2 {
            color: #ffd966;
            font-size: 36px;
            margin: 0;
        }
        .stats-item p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span>Admin Dashboard</span>
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
        <div class="stats-card">
            <div class="stats-item">
                <h2>10</h2>
                <p>Amount of Users</p>
            </div>
            <div class="stats-item">
                <h2>3</h2>
                <p>Amount of Stores</p>
            </div>
        </div>
    </div>
</body>
</html>
