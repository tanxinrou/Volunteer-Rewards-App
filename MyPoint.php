<?php 
include "db_connect.php";

$arrContent = array();

$query = "SELECT * FROM coupon";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result)){
    $arrContent[] = $row; 
}

// Assume a placeholder for the current points of the user
$currentPoints = 100; // Set this to your user's actual points from the database
?>

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
            background-color: #f8d775;
        }
        .reward-section, .qr-section {
            background-color: #f8d775;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin: 10px 0;
        }
        .coupon-section {
            margin-top: 20px;
        }
        .coupon-card {
            cursor: pointer;
        }
        .card {
            height: 100%; /* Keep all cards the same height */
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
    </style>

    <!-- Bootstrap 5 JS and Popper for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <!-- Script for Redemption -->
    <script>
        let redeemedCoupons = [];
        let redeemInProgress = false; // Flag to track if redemption is in progress
        let currentPoints = <?php echo $currentPoints; ?>; // Placeholder for current points (this should come from the backend)

        function redeemCoupon(couponId, title, pointsRequired) {
            // Check if the user has enough points
            if (currentPoints < pointsRequired) {
                alert("You do not have enough points to redeem this coupon.");
                return;
            }

            // If coupon is already redeemed, show message and return
            if (redeemedCoupons.includes(couponId)) {
                showRedeemedMessage();
                return;
            }

            if (redeemInProgress) return; // Prevent further redemption attempts if it's in progress

            // Generate a 6-digit random number (PIN)
            let pin = Math.floor(100000 + Math.random() * 900000);

            // Disable the redeem button for this coupon
            document.getElementById("redeemBtn_" + couponId).disabled = true;

            // Store the redeemed coupon ID
            redeemedCoupons.push(couponId);

            // Update modal content with coupon title and pin
            document.getElementById("couponTitle").innerText = title;
            document.getElementById("redeemPin").innerText = pin;

            // Update remaining coupon count in the UI
            const remainingElement = document.getElementById("remaining_" + couponId);
            remainingElement.innerText = parseInt(remainingElement.innerText) - 1;

            // Deduct points from the user's balance
            currentPoints -= pointsRequired;
            document.getElementById("rewardPoints").innerText = currentPoints; // Update the points on the page

            // Show alert for points deduction
            alert("You have been deducted " + pointsRequired + " points for redeeming this coupon.");

            // Show the modal for the redemption process
            var redeemModal = new bootstrap.Modal(document.getElementById('redeemModal'));
            redeemModal.show();

            redeemInProgress = true; // Mark redemption as in progress
        }

        function showRedeemedMessage() {
            var redeemedModal = new bootstrap.Modal(document.getElementById('redeemedModal'));
            redeemedModal.show(); // Show the modal for already redeemed message
        }

        // This function is triggered when the "Cancel" button is clicked
        function cancelRedemption() {
            redeemInProgress = false; // Reset redemption flag
            // Reset button state (enable it again)
            document.querySelectorAll('.redeem-btn').forEach((btn) => {
                btn.disabled = false;
            });
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <?php include "navbar.php"; ?>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row align-items-stretch">
            <div class="col-md-6">
                <div class="reward-section h-100 d-flex flex-column justify-content-center">
                    <h4>Rewards Points</h4>
                    <p class="fs-3" id="rewardPoints"><?php echo $currentPoints; ?></p> <!-- Display current points here -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="qr-section h-100 d-flex flex-column justify-content-center align-items-center">
                    <h4>Scan QR</h4>
                    <a href="scan_page.php">
                        <img src="ScanMeQR.png" alt="QR Code" class="img-fluid" style="width: 100px; height: 100px;">
                    </a>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h3>Coupons</h3>
            <div class="row">
                <?php
                for ($i = 0; $i < count($arrContent); $i++) {
                    $id = $arrContent[$i]['couponId'];
                    $title = $arrContent[$i]['couponTitle'];
                    $description = $arrContent[$i]['couponDescription'];
                    $image = $arrContent[$i]['Image'];
                    $pointsrequired = $arrContent[$i]['pointsRequired'];
                    $quantityRemaining = $arrContent[$i]['quantityRemaining'];

                    if ($image == "none") {
                        $image = "BreadTalk.png"; // Default image if none is provided
                        $image = "donation.jpg";
                    }
                ?>
                    <div class="col-md-4 mb-3">
<<<<<<< HEAD
                        <div class="coupon-card" onclick="redeemCoupon(<?php echo $id; ?>, '<?php echo $title; ?>', <?php echo $pointsrequired; ?>)">
                            <div class="card text-light bg-dark">
                                <img class="card-img-top" src="Images/<?php echo $image; ?>" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $title ?></h4>
                                    <p class="card-text"><?php echo $description ?></p>
                                    <p class="card-text">Points Required: <?php echo $pointsrequired ?></p>
                                    <p class="card-text">Remaining: <span id="remaining_<?php echo $id; ?>"><?php echo $quantityRemaining ?></span> left</p>
                                    <button id="redeemBtn_<?php echo $id; ?>" class="btn btn-warning redeem-btn" onclick="event.stopPropagation(); redeemCoupon(<?php echo $id; ?>, '<?php echo $title; ?>', <?php echo $pointsrequired; ?>)">Redeem</button>
                                </div>
=======
                        <div class="card text-light bg-dark">
                            <img class="card-img-top" src="<?php echo $image; ?>" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $title ?></h4>
                                <p class="card-text"><?php echo $description ?></p>
                                <p class="card-text">Points Required: <?php echo $pointsrequired ?></p>
                                <p class="card-text">Remaining: <?php echo $quantityRemaining ?> left</p>
>>>>>>> 998f79654acc0932592e7bd21a57848a96c461e2
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Redemption PIN Modal -->
    <div class="modal fade" id="redeemModal" tabindex="-1" aria-labelledby="redeemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="redeemModalLabel">Redemption PIN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4 id="couponTitle"></h4>
                    <p>Your redemption PIN is:</p>
                    <h2 class="fw-bold text-danger" id="redeemPin"></h2>
                </div>
                <div class="modal-footer">
                    <!-- Close Button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-warning" onclick="cancelRedemption()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Already Redeemed Message Modal -->
    <div class="modal fade" id="redeemedModal" tabindex="-1" aria-labelledby="redeemedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="redeemedModalLabel">Coupon Redeemed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h2 class="fw-bold text-success">Coupon has successfully been redeemed!</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
