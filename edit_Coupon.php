<?php
include 'db_connect.php';

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the coupon ID from the URL
if (isset($_GET['couponId'])) {
    $couponId = $_GET['couponId'];

    // Fetch the coupon data from the database
    $sql = "SELECT * FROM coupon WHERE couponId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $couponId);
    $stmt->execute();
    $result = $stmt->get_result();
    $coupon = $result->fetch_assoc();

    // If no coupon found, redirect back to coupon list
    if (!$coupon) {
        header("Location: coupon_list.php");
        exit;
    }
}

// Update coupon details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $couponTitle = $_POST['couponTitle'];
    $couponDescription = $_POST['couponDescription'];
    $storeId = $_POST['storeId'];
    $pointsRequired = $_POST['pointsRequired'];
    $quantityIssued = $_POST['quantityIssued'];
    $quantityRemaining = $_POST['quantityRemaining'];
    $image = $_POST['image'];

    // Prepare SQL statement to update coupon data
    $updateSql = "UPDATE coupon SET couponTitle = ?, couponDescription = ?, storeId = ?, pointsRequired = ?, quantityIssued = ?, quantityRemaining = ?, Image = ? WHERE couponId = ?";
    $stmtUpdate = $conn->prepare($updateSql);
    $stmtUpdate->bind_param("ssiiissi", $couponTitle, $couponDescription, $storeId, $pointsRequired, $quantityIssued, $quantityRemaining, $image, $couponId);

    if ($stmtUpdate->execute()) {
        echo "<p>Coupon updated successfully!</p>";
        // Redirect to coupon list after successful update
        header("Location: coupon_list.php");
        exit;
    } else {
        echo "<p>Error updating coupon: " . $stmtUpdate->error . "</p>";
    }
}

// Delete coupon if delete is requested
if (isset($_GET['delete'])) {
    $deleteSql = "DELETE FROM coupon WHERE couponId = ?";
    $stmtDelete = $conn->prepare($deleteSql);
    $stmtDelete->bind_param("i", $couponId);
    
    if ($stmtDelete->execute()) {
        echo "<p>Coupon deleted successfully!</p>";
        // Redirect to coupon list after deletion
        header("Location: coupon_list.php");
        exit;
    } else {
        echo "<p>Error deleting coupon: " . $stmtDelete->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coupon</title>
    <style>
    /* Styling for body and general layout */
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    /* Navbar styling */
    .navbar {
        background-color: #002060;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
        padding: 0 20px;
    }

    /* Sidebar styling */
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

    /* Content area styling */
    .content {
        margin-left: 170px;
        padding: 20px;
    }

    /* Form container */
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

    /* Input fields */
    .form-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Common button styling */
    .form-container button,
    .delete-btn {
        width: 48%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        text-align: center;
        display: inline-block;
    }

    /* Update button style */
    .form-container button {
        background-color: #ffd966;
        color: #002060;
    }

    /* Delete button style */
    .delete-btn {
        background-color: #b30000; /* Changed to a darker red */
        color: white;
    }

    /* Button hover effects */
    .form-container button:hover,
    .delete-btn:hover {
        opacity: 0.8;
    }

    /* Buttons side by side */
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
</style>

</head>
<body>

<div class="navbar">
    <span>Edit Coupon</span>
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
        <h2>Edit Coupon</h2>
        <form method="POST">
            <label for="couponTitle">Coupon Title:</label>
            <input type="text" id="couponTitle" name="couponTitle" value="<?php echo htmlspecialchars($coupon['couponTitle']); ?>" required>

            <label for="couponDescription">Description:</label>
            <input type="text" id="couponDescription" name="couponDescription" value="<?php echo htmlspecialchars($coupon['couponDescription']); ?>" required>

            <label for="storeId">Store ID:</label>
            <input type="number" id="storeId" name="storeId" value="<?php echo htmlspecialchars($coupon['storeId']); ?>" required>

            <label for="pointsRequired">Points Required:</label>
            <input type="number" id="pointsRequired" name="pointsRequired" value="<?php echo htmlspecialchars($coupon['pointsRequired']); ?>" required>

            <label for="quantityIssued">Quantity Issued:</label>
            <input type="number" id="quantityIssued" name="quantityIssued" value="<?php echo htmlspecialchars($coupon['quantityIssued']); ?>" required>

            <label for="quantityRemaining">Quantity Remaining:</label>
            <input type="number" id="quantityRemaining" name="quantityRemaining" value="<?php echo htmlspecialchars($coupon['quantityRemaining']); ?>" required>

            <label for="image">Image Filename:</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($coupon['Image']); ?>" required>

            <div class="button-group">
                <button type="submit">Update Coupon</button>
                <button class="delete-btn" onclick="return confirm('Are you sure you want to delete this coupon?')">
                    Delete Coupon
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$conn->close();
?>

</body>
</html>
