<?php
session_start();
include "db_connect.php"; // Ensure database connection

$errorMsg = "";
$PointsRewarded = 50; // Example points to be rewarded

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["scanned_qr"])) {
    $scannedQR = mysqli_real_escape_string($conn, $_POST["scanned_qr"]);

    // Check if QR is valid (Assume we check in a `coupons` table)
    $query = "SELECT * FROM coupons WHERE qr_code = '$scannedQR' AND redeemed = 0";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update coupon as redeemed and reward user
        $updateQuery = "UPDATE users SET Points = Points + $PointsRewarded WHERE username = '{$_SESSION['username']}'";
        mysqli_query($conn, $updateQuery);

        // Mark the QR code as redeemed
        $updateCouponQuery = "UPDATE coupons SET redeemed = 1 WHERE qr_code = '$scannedQR'";
        mysqli_query($conn, $updateCouponQuery);

        header("Location: success.php?points=$PointsRewarded");
        exit();
    } else {
        $errorMsg = "⚠️ Invalid or Already Redeemed QR Code.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 20px;
        }
        .header-section {
            background-color: #102042;
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
        .scan-container {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .scan-box {
            flex: 1;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 350px;
        }
        video, #qr-reader {
            border: 2px solid #102042;
            border-radius: 10px;
            width: 100%;
            height: auto;
        }
        .status {
            margin-top: 10px;
            color: #dc3545;
        }
        .qr-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
        }
        #upload-submit {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <div class="header-section">
            <h4>Scan QR Code</h4>
            <p>Use your camera or upload an image to scan a QR code and redeem rewards!</p>
        </div>

        <div class="scan-container">
            <!-- Live Camera QR Scanner -->
            <div class="scan-box">
                <h5>Scan Using Camera</h5>
                <div id="qr-camera"></div>
                <p id="camera-status" class="status"></p>
            </div>

            <!-- Upload QR Code -->
            <div class="scan-box">
                <h5>Upload QR Code</h5>
                <input type="file" id="qr-input-file" accept="image/*" class="form-control mt-3">
                <p id="upload-status" class="status"></p>
                <form id="qr-upload-form" method="POST">
                    <input type="hidden" name="scanned_qr" id="scanned_qr">
                    <button type="submit" id="upload-submit" class="btn btn-primary w-100" disabled>Submit</button>
                </form>
            </div>
        </div>

        <!-- Unable to Scan Link -->
        <a href="#" class="qr-link" data-bs-toggle="modal" data-bs-target="#scanIssueModal">Unable to scan the QR code?</a>

        <?php if ($errorMsg): ?>
            <div class="alert alert-danger mt-3"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
    </div>

    <script>
        let scannedCode = "";

        // Live QR Scanner
        const html5QrCode = new Html5Qrcode("qr-camera");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            (decodedText) => {
                alert(`✅ QR Code Scanned: ${decodedText}`);
                document.getElementById("scanned_qr").value = decodedText;
                document.getElementById("qr-upload-form").submit();
            },
            (error) => {
                document.getElementById("camera-status").textContent = "Error scanning QR code. Try again.";
            }
        ).catch(err => {
            document.getElementById("camera-status").textContent = "⚠️ Camera access error.";
        });

        // Upload QR Code from Image
        document.getElementById("qr-input-file").addEventListener("change", function(event) {
            if (event.target.files.length === 0) return;
            
            const imageFile = event.target.files[0];
            const qrScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });

            html5QrCode.scanFile(imageFile, true)
                .then(decodedText => {
                    alert(`✅ QR Code from Image: ${decodedText}`);
                    document.getElementById("scanned_qr").value = decodedText;
                    document.getElementById("upload-submit").disabled = false;
                })
                .catch(err => {
                    document.getElementById("upload-status").textContent = "Failed to read QR code.";
                    document.getElementById("upload-submit").disabled = true;
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
