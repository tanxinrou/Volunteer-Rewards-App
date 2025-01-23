<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div class="container">
        <h4>Scan the QR Code</h4>
        
        <!-- This div will hold the camera feed for scanning -->
        <div id="reader" style="width: 100%; height: 400px;"></div>

        <script>
            function onScanSuccess(decodedText, decodedResult) {
                // This function is triggered when the QR code is successfully scanned
                alert(`QR Code scanned: ${decodedText}`);
                
                // You can redirect the user to another page based on the scanned data
                // If it’s a coupon ID or a URL, you can use it to redirect
                window.location.href = `redeem_coupon.php?coupon_id=${decodedText}`;
            }

            function onScanError(errorMessage) {
                // Handle any scanning errors
                console.error(errorMessage);
            }

            // Initialize the QR code scanner
            const html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" }, // Use the rear camera (if available)
                {
                    fps: 10,  // Set the frames per second
                    qrbox: 250  // Set the scanning box size
                },
                onScanSuccess,  // Callback on successful scan
                onScanError     // Callback on scan error
            );
        </script>
    </div>
</body>
</html>
