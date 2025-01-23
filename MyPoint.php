<?php 
include "db_connect.php";

// Initialize the array to hold coupon data
$arrContent = array();

$query = "SELECT * FROM coupon";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result)){
    $arrContent[] = $row; // Populate the array with rows from the result
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
                    <!-- Wrap the QR image with a link to the scanning page -->
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
                    $quantityIssued = $arrContent[$i]['quantityIssued'];
                    $quantityRemaining = $arrContent[$i]['quantityRemaining'];

                    if ($image == "none") {
                        $image = "none.jpg"; // Default image if none is provided
                    }
                ?>
                    <div class="col-md-4 mb-3">
                        <div class="card text-light bg-dark">
                            <img class="card-img-top" src="Images/<?php echo $image; ?>" alt="Card image">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $title ?></h4>
                                <p class="card-text"><?php echo $description ?></p>
                                <p class="card-text">Points Required: <?php echo $pointsrequired ?></p>
                                <p class="card-text">Remaining: <?php echo $quantityRemaining ?> left</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</body>
</html>
