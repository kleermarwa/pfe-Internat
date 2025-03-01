<?php
session_start();
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_cin = trim($_POST['username']); 
    $pass = trim($_POST['password']);

    if ($stmt = $conn->prepare("SELECT id, role, status, filiere, password FROM users WHERE email = ? OR cin = ?")) {
        $stmt->bind_param("ss", $email_or_cin, $email_or_cin);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['filliere'] = $row['filiere'];

            // Check password (assuming plain-text; use password_hash in production)
            if ($row['password'] === NULL || $row['password'] === '' || $pass === $row['password']) {
                $redirects = [
                    'student' => 'profile.php',
                    'departement' => '../admin/departement_degats.php',
                    'internat' => '../admin/internatGarcons.php',
                    'economique' => '../admin/serviceEconomique.php',
                    'administration' => '../admin/index.php',
                    'restaurant' => '../admin/restaurant.php',
                    'super_admin' => '../index.php',
                    'admin' => '../index.php'
                ];
                header("Location: " . ($redirects[$row['role']] ?? 'profile.php'));
                exit();
            } else {
                $error = "Mot de passe incorrect!";
            }
        } else {
            $error = "Email ou CIN incorrect!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-css.css">
    <script src="https://code.ionicframework.com/ionicons/2.0.1/js/ionicons.min.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="your-logo.png" alt="Logo"> <!-- Change 'your-logo.png' to your actual logo file -->
        </div>
        <h2 style="text-align: center; color: white;">Login</h2>
        
        <?php if(isset($error)) echo "<p style='color:red; text-align: center;'>$error</p>"; ?>
        
        <form action="login.php" method="POST">
            <div class="username">
                <label for="username" style="color: white;">Email or CIN</label>
                <div class="input-container">
                    <ion-icon name="person"></ion-icon>
                    <input type="text" name="username" id="username" placeholder="Enter your email or CIN" required>
                </div>
            </div>

            <div class="password">
                <label for="password" style="color: white;">Password</label>
                <div class="input-container">
                    <ion-icon name="lock"></ion-icon>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <span class="show-hide" onclick="togglePassword()">Show</span>
                </div>
            </div>

            <button type="submit" class="login">Login</button>
        </form>

        <div class="footer">
            <span>Forgot Password?</span>
            <a href="register.php" class="link" style="color: white; text-decoration: none;">Register</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleText = document.querySelector(".show-hide");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleText.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleText.textContent = "Show";
            }
        }
    </script>
</body>
</html>
