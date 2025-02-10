<?php
require 'db_connect.php'; // Connect to the database

if (isset($_GET['coupon_id'])) {
    $couponId = $_GET['coupon_id'];

    // Check if the QR code is valid
    $stmt = $link->prepare("SELECT * FROM coupons WHERE CouponCode = ?");
    $stmt->bind_param("s", $couponId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the user's points
        $PointsRewarded = 50; // Set your reward points
        $updateStmt = $link->prepare("UPDATE users SET Points = Points + ? WHERE UserID = ?");
        $updateStmt->bind_param("ii", $PointsRewarded, $userId);
        $updateStmt->execute();

        echo "<script>alert('✅ Coupon redeemed! You received $PointsRewarded points.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Invalid QR Code!'); window.location.href='scan_qr.php';</script>";
    }
}
?>
