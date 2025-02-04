<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "fyp");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the coupon ID from the URL
$couponId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch coupon details
$sql = "SELECT * FROM coupon WHERE couponId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $couponId);
$stmt->execute();
$result = $stmt->get_result();
$coupon = $result->fetch_assoc();

if (!$coupon) {
    echo "Coupon not found.";
    exit;
}

// Update coupon details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $pointsRequired = intval($_POST['pointsRequired']);
    $quantityIssued = intval($_POST['quantityIssued']);
    $quantityRemaining = intval($_POST['quantityRemaining']);
    
    $update_sql = "UPDATE coupon SET couponTitle=?, couponDescription=?, pointsRequired=?, quantityIssued=?, quantityRemaining=? WHERE couponId=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssiiii", $title, $description, $pointsRequired, $quantityIssued, $quantityRemaining, $couponId);
    
    if ($update_stmt->execute()) {
        echo "Coupon updated successfully.";
    } else {
        echo "Error updating coupon: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coupon</title>
</head>
<body>
    <h2>Edit Coupon</h2>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($coupon['couponTitle']); ?>" required><br>

        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($coupon['couponDescription']); ?></textarea><br>

        <label>Points Required:</label>
        <input type="number" name="pointsRequired" value="<?php echo $coupon['pointsRequired']; ?>" required><br>

        <label>Quantity Issued:</label>
        <input type="number" name="quantityIssued" value="<?php echo $coupon['quantityIssued']; ?>" required><br>

        <label>Quantity Remaining:</label>
        <input type="number" name="quantityRemaining" value="<?php echo $coupon['quantityRemaining']; ?>" required><br>

        <button type="submit">Update Coupon</button>
    </form>
    <a href="coupon_list.php">Back to Coupons</a>
</body>
</html>
<?php
$conn->close();
?>

