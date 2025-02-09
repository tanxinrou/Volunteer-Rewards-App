<?php
include "db_connect.php";

// Assume we have a store_id for the logged-in store admin (replace with actual logic)
$storeId = 123; // Example store ID, replace with session data or similar

// Fetch store-specific coupons
$query = "SELECT * FROM coupon WHERE storeId = $storeId";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$arrContent = array();
while ($row = mysqli_fetch_array($result)) {
    $arrContent[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d775;
        }

        .coupon-section {
            margin-top: 20px;
        }

        .coupon-card {
            cursor: pointer;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .redeem-btn {
            width: 100%;
        }

        .pin-input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .redeem-section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include "navbar.php"; ?>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Coupons Section -->
            <div class="col-md-6">
                <h3>Your Store Coupons</h3>
                <div class="coupon-section">
                    <div class="row">
                        <?php
                        foreach ($arrContent as $coupon) {
                            $id = $coupon['couponId'];
                            $title = $coupon['couponTitle'];
                            $description = $coupon['couponDescription'];
                            $image = $coupon['Image'] ?: 'default-image.png'; // Default image
                            $pointsrequired = $coupon['pointsRequired'];
                            $quantityRemaining = $coupon['quantityRemaining'];
                        ?>
                            <div class="col-md-4 mb-3">
                                <div class="coupon-card">
                                    <div class="card text-light bg-dark">
                                        <img class="card-img-top" src="Images/<?php echo $image; ?>" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $title; ?></h4>
                                            <p class="card-text"><?php echo $description; ?></p>
                                            <p class="card-text">Points Required: <?php echo $pointsrequired; ?></p>
                                            <p class="card-text">Remaining: <span id="remaining_<?php echo $id; ?>"><?php echo $quantityRemaining; ?></span> left</p>
                                            <button id="redeemBtn_<?php echo $id; ?>" class="btn btn-warning redeem-btn" onclick="redeemCoupon(<?php echo $id; ?>, '<?php echo $title; ?>', <?php echo $pointsrequired; ?>)">Redeem</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- PIN Input Section -->
            <div class="col-md-6">
                <h3>Enter 6-Digit PIN to Redeem Coupon</h3>
                <div class="redeem-section">
                    <label for="pinInput" class="form-label">Enter PIN:</label>
                    <input type="text" id="pinInput" class="pin-input" maxlength="6" placeholder="Enter 6-digit PIN" oninput="validatePin()">
                    <button class="btn btn-success mt-3" id="redeemButton" onclick="redeemWithPin()" disabled>Redeem</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check the PIN input to enable the redeem button
        function validatePin() {
            const pinInput = document.getElementById("pinInput").value;
            const redeemButton = document.getElementById("redeemButton");

            // Enable the redeem button if the pin is 6 digits
            if (pinInput.length === 6) {
                redeemButton.disabled = false;
            } else {
                redeemButton.disabled = true;
            }
        }

        // Function to redeem coupon with the 6-digit PIN
        function redeemWithPin() {
            const pin = document.getElementById("pinInput").value;
            if (pin.length !== 6) {
                alert("Please enter a valid 6-digit PIN.");
                return;
            }

            // Call the redeemCoupon function with store-specific coupon logic
            alert("Coupon redeemed successfully with PIN: " + pin);
            // You can call the server-side logic here for PIN validation
        }
    </script>

</body>
</html>
