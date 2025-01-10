<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Volunteering Rewards</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Registration Container */
        .registration-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .registration-container h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #444;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 0.9em;
            color: #666;
            text-align: left;
        }

        input, select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            background-color: #E8C766; /* Yellow inputs */
        }

        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Checkbox Styling */
        label[for="terms"] {
            font-size: 0.85em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Button Styling */
        button {
            padding: 10px;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            background-color: #3361AC; /* Blue button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #26487e; /* Darker blue on hover */
        }

        /* Profile Image Styling */
        .profile-img {
            width: 200px;
            height: 180px;
            border-radius: 50%;
            margin-bottom: 50px;
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
            <input type="password" id="confirm-password" name="confirm-password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="volunteer">Volunteer</option>
                <option value="admin">Admin</option>
            </select>

            <label for="terms">
                <input type="checkbox" id="terms" name="terms" required> I agree to the terms and conditions.
            </label>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>