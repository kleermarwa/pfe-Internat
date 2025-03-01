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
            // Store user session data
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['filliere'] = $row['filliere'];

            // Check password (assuming plain-text; use password_hash in production)
            if ($row['password'] === NULL || $row['password'] === '' || $pass === $row['password']) {
                // Redirect based on user role
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <a href="register.php" class="link">Don't have an account? Register</a>
    </div>
</body>
</html>
