<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #102042;
            color: white;
        }
        .navbar-brand div {
            display: flex;
            align-items: center;
        }
        .navbar-brand div div {
            width: 50px;
            height: 50px;
            background-color: #102042;
            border-radius: 50%;
        }
        .navbar a {
            color: white;
            text-decoration: none;
        }
        .btn-custom {
            background-color: #E8C766;
            color: white;
        }
        .btn-custom:hover {
            background-color: #d2b058;
            color: white;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg p-3">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <div class="navbar-brand">
            <div>
                <div></div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div>
            <a class="btn btn-custom me-2" href="MyPoint.html">My Points</a>
            <a class="btn btn-custom me-2" href="#">Events</a>
            <a class="btn btn-custom" href="#">My Profile</a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
