<?php
// Include the database connection script
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Add a coupon if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $couponTitle = $_POST['couponTitle'];
    $couponDescription = $_POST['couponDescription'];
    $storeId = $_POST['storeId'];
    $pointsRequired = $_POST['pointsRequired'];
    $quantityIssued = $_POST['quantityIssued'];
    $quantityRemaining = $_POST['quantityRemaining'];
    $image = $_POST['image'];

    // Prepare SQL statement to insert coupon data into the database
    $stmt = $conn->prepare("INSERT INTO coupon (couponTitle, couponDescription, storeId, pointsRequired, quantityIssued, quantityRemaining, Image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiiss", $couponTitle, $couponDescription, $storeId, $pointsRequired, $quantityIssued, $quantityRemaining, $image);
    
    // Execute the query and handle success/error
    if ($stmt->execute()) {
        echo "<p>Coupon added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon</title>
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
        <div class="form-container">
            <h2>Add New Coupon</h2>
            <form method="POST">
                <label for="couponTitle">Coupon Title:</label>
                <input type="text" id="couponTitle" name="couponTitle" required>

                <label for="couponDescription">Description:</label>
                <input type="text" id="couponDescription" name="couponDescription" required>

                <label for="storeId">Store ID:</label>
                <input type="number" id="storeId" name="storeId" required>

                <label for="pointsRequired">Points Required:</label>
                <input type="number" id="pointsRequired" name="pointsRequired" required>

                <label for="quantityIssued">Quantity Issued:</label>
                <input type="number" id="quantityIssued" name="quantityIssued" required>

                <label for="quantityRemaining">Quantity Remaining:</label>
                <input type="number" id="quantityRemaining" name="quantityRemaining" required>

                <label for="image">Image Filename:</label>
                <input type="text" id="image" name="image" required>

                <button type="submit">Add Coupon</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
