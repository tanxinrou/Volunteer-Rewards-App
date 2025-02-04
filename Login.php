
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> 
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm">
            <img src="Profile image.png" alt="Profile" class="profile-img" size="200px">
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            
            <div class="remember-me-container">
                <label>
                    <input type="checkbox" id="rememberMe">
                    Remember Me
                </label>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>