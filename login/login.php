<?php
include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Your authentication logic here

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Process login
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="logo (2).png" alt="logo">
        </div>
        <form method="post" action="">
            <div class="username">
                <label for="username">Email / CIN</label>
                <div class="input-container">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" id="username" name="username" placeholder="Email or CIN" required>
                </div>
            </div>

            <div class="password">
                <label for="password">Password</label>
                <div class="input-container">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password" name="password" placeholder="Password.." required>
                    <span class="show-hide" onclick="togglePasswordVisibility()">Show</span>
                </div>
            </div>

            <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

            <button type="submit" class="login">Login</button>
        </form>
        <div class="footer">
            <span><a href="sign-in.php">Sign up</a></span>
            <span>Forgot Password?</span>
        </div>
    </div>
    <script type="text/javascript" src="login.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const showHideButton = passwordField.nextElementSibling;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showHideButton.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                showHideButton.textContent = 'Show';
            }
        }
    </script>
</body>
</html>