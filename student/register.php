<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cin = $_POST['cin'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("SELECT email FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "This email is already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (cin, name, email, password, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cin, $name, $email, $password, $phone);

        if ($stmt->execute()) {
            header("Location: ../login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
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
    <link rel="stylesheet" href="register.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../logo (2).png" alt="logo">
        </div>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="register.php" method="POST">
            <div class="form-row">
                <div class="username">
                    <label for="cin">CIN</label>
                    <div class="input-container">
                        <ion-icon name="card-outline"></ion-icon>
                        <input type="text" id="cin" name="cin" placeholder="CIN" required>
                    </div>
                </div>
                <div class="username">
                    <label for="name">Full Name</label>
                    <div class="input-container">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" id="name" name="name" placeholder="Full Name" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="username">
                    <label for="email">Email</label>
                    <div class="input-container">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="username">
                    <label for="phone">Phone Number</label>
                    <div class="input-container">
                        <ion-icon name="call-outline"></ion-icon>
                        <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>
            </div>
            <div class="password">
                <label for="password">Password</label>
                <div class="input-container">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="show-hide" onclick="togglePasswordVisibility()">Show</span>
                </div>
            </div>
            <button type="submit" class="login">Register</button>
        </form>
        <div class="footer">
            <span><a href="../login.php">Already have an account? Login</a></span>
        </div>
    </div>
    <script type="text/javascript" src="../login.js"></script>
</body>
</html>
