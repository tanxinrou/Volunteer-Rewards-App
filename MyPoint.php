<?php
include 'db_connect.php';  

$query = "SELECT * FROM coupon";
$result = mysqli_query($conn, $query);

if(!$result) {
    die("Error fetching coupons: " . mysqli_error($conn));
}
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
        }
        .navbar {
            background-color: #102042;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
        }
        .header-section {
            text-align: center;
            margin-top: 20px;
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
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            cursor: pointer;
        }
        .coupon-card img {
            width: 100%;
            height: auto;
        }
        .coupon-card .card-body {
            padding: 10px;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<?php include "navbar.php"; ?>

<!-- Main Content -->
<div class="container mt-4">
    <!-- Rewards and QR -->
    <div class="row align-items-stretch">
        <div class="col-md-6">
            <div class="reward-section h-100 d-flex flex-column justify-content-center">
                <h4>Rewards Points</h4>
                <p class="fs-3">0.00</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="qr-section h-100 d-flex flex-column justify-content-center align-items-center">
                <h4>Scan QR</h4>
                <img src="ScanMeQR.png" alt="QR Code" class="img-fluid" style="width: 100px; height: 100px;"> <!-- Reduced size QR code, centered -->
            </div>
        </div>
    </div>

    <!-- Coupons Section -->
    <div class="coupon-section">
        <h4>Coupons:</h4>
        <div class="row">
            <?php while($coupon = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="coupon-card" data-bs-toggle="modal" data-bs-target="#couponModal">
                    <img src="images/<?php echo $coupon['Image']; ?>" alt="<?php echo $coupon['couponTitle']; ?>"> <!-- Display coupon image -->
                    <div class="card-body">
                        <p><?php echo $coupon['couponTitle']; ?></p>
                        <p><?php echo $coupon['pointsRequired']; ?> Reward Points</p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="couponModalLabel">Coupon Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="form-control" rows="4" placeholder="Enter description here..."></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Redeem</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
