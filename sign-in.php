<?php
include __DIR__ . '/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cin = isset($_POST['cin']) ? $_POST['cin'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    if (empty($cin) || empty($name) || empty($email) || empty($password) || empty($gender)) {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO students (cin, name, email, password, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cin, $name, $email, $hashedPassword, $gender);

        if ($stmt->execute()) {
            $success = "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            $error = "Error: " . $stmt->error;
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
    <title>Sign In</title>
    <link rel="stylesheet" href="login.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<style>
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Creates two equal columns */
    gap: 15px; /* Adds space between elements */
}
.login-container {
    background-color: rgba(25, 167, 228, 0.8);
    padding: 30px; /* Increased padding for more space inside */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 540px; /* Increased width */
    max-width: 100%; /* Prevents overflow on smaller screens */
    text-align: center;
}
</style>    

<body>
    <div class="login-container">
        <div class="logo">
            <img src="logo (2).png" alt="logo">
        </div>
        <h2>Sign Up</h2>
        <form method="post" action="">
            <div class="form-grid">
                <div class="cin">
                    <label for="cin">CIN</label>
                    <div class="input-container">
                        <ion-icon name="id-card-outline"></ion-icon>
                        <input type="text" id="cin" name="cin" placeholder="Enter CIN" required>
                    </div>
                </div>
                <div class="name">
                    <label for="name">Name</label>
                    <div class="input-container">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="email">
                    <label for="email">Email</label>
                    <div class="input-container">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                </div>
            </div>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
        </form>
        <div class="footer">
            <span>Already have an account?</span>
            <a href="login.php">Login</a>
        </div>
        <button type="submit" class="login">Sign In</button>
    </div>
    <script src="script.js"></script>
</body>
</html>
