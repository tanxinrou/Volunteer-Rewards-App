<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Instascan.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/instascan.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background */
        }
        .container {
            margin-top: 20px;
            max-width: 800px;
        }
        .header-section {
            background-color: #102042;
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
        .video-section {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        video {
            border: 2px solid #102042;
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }
        .status {
            margin-top: 15px;
            color: #dc3545; /* Red for errors */
        }
        .qr-link {
            margin-top: 15px;
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Include the navbar -->
    <?php include "navbar.php"; ?>

    <div class="container">
        <!-- Header Section -->
        <div class="header-section">
            <h4>Scan QR Code</h4>
            <p>Use your camera to scan a QR code and redeem your rewards!</p>
        </div>

        <!-- Video Section -->
        <div class="video-section">
            <video id="preview"></video>
            <p id="status" class="status"></p>
            <!-- Replace the button with an anchor link -->
            <a href="#" class="qr-link" data-bs-toggle="modal" data-bs-target="#scanIssueModal">Unable to scan the QR code?</a>
        </div>
    </div>

    <!-- Modal for scanning issue -->
    <div class="modal fade" id="scanIssueModal" tabindex="-1" aria-labelledby="scanIssueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanIssueModalLabel">QR Code Scan Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="scanIssueForm">
                        <div class="mb-3">
                            <label for="userId" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="userId" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventId" class="form-label">Event ID</label>
                            <input type="text" class="form-control" id="eventId" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS and Popper for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <script>
        // Initialize scanner
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        const statusText = document.getElementById('status');

        // Define the behavior when a QR code is scanned
        scanner.addListener('scan', function (content) {
            alert(`QR Code scanned: ${content}`);
            // Redirect to another page based on the scanned content
            window.location.href = `redeem_coupon.php?coupon_id=${content}`;
        });

        // Try to get cameras and start scanning
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                // Attempt to start the rear camera first
                let rearCamera = cameras.find(camera => camera.name && camera.name.includes('back'));
                scanner.start(rearCamera || cameras[0]);
                statusText.textContent = ''; // Clear status message
            } else {
                console.error('No cameras found.');
                statusText.textContent = 'No cameras found on this device.';
            }
        }).catch(function (error) {
            console.error('Camera access error:', error);
            statusText.textContent = `Error accessing camera: ${error.message}`;
        });

        // Handle the scan issue form submission
        document.getElementById('scanIssueForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const userId = document.getElementById('userId').value;
            const eventId = document.getElementById('eventId').value;

            // Handle form submission (send the data to the server or process as needed)
            console.log(`User ID: ${userId}, Event ID: ${eventId}`);
            alert("Form submitted successfully!");

            // Close the modal after submission
            var scanIssueModal = new bootstrap.Modal(document.getElementById('scanIssueModal'));
            scanIssueModal.hide();
        });
    </script>
</body>
</html>
