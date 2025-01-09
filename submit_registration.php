<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration - Volunteering Rewards</title>
        <style>
            *{
               margin: 0;
               padding: 0;
               box-sizing: border-box; 
            }
        </style>
    </head>
    <body>
        <div class="registration-container">
            <h2>Register for Volunteering Rewards</h2>
            <form action="submit_registration.php" method="POST" id="registration-form">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm-password">Confirm Password:</label>
                <input type="confirm-password" id="confirm-password" name="confirm-password" required>  
                
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="volunteer">Volunteer</option>
                    <option value="admin">Admin</option>
                </select>

                <label for="terms">
                    <input type="checkbox" id="terms" name="terms" required> I agree to this terms and conditions.
                </label>

                <button type="submit">Register</button>
             </form>
        </div>
        <script src="script.js"></script>
    </body>
</html>