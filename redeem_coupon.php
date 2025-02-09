<?php
include "db_connect.php";

if (isset($_POST['couponId'])) {
    $couponId = $_POST['couponId'];

    // Update the coupon count in the database
    $query = "UPDATE coupon SET quantityRemaining = quantityRemaining - 1 WHERE couponId = $couponId";
    if (mysqli_query($conn, $query)) {
        echo "Coupon redeemed successfully!";
    } else {
        echo "Error redeeming coupon: " . mysqli_error($conn);
    }
}
?>
