<?php
include 'db_connect.php';

// Assume the QR code contains the volunteer ID or coupon ID
if (isset($_GET['volunteer_id'])) {
    $volunteer_id = $_GET['volunteer_id'];

    // Fetch current points of the volunteer
    $query = "SELECT points FROM volunteers WHERE volunteer_id = '$volunteer_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_points = $row['points'];

        // Add points to volunteer's account (add logic for the points to be added)
        $new_points = $current_points + 10; // Example: Add 10 points
        $update_query = "UPDATE volunteers SET points = '$new_points' WHERE volunteer_id = '$volunteer_id'";

        if (mysqli_query($conn, $update_query)) {
            echo "Points updated successfully.";
        } else {
            echo "Error updating points: " . mysqli_error($conn);
        }
    } else {
        echo "Volunteer not found.";
    }
} else {
    echo "No volunteer ID provided.";
}

// Close the database connection
mysqli_close($conn);
?>
