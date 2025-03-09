<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cin = isset($_POST['cin']) ? $_POST['cin'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    if (empty($cin) || empty($name) || empty($email) || empty($password) || empty($gender) || empty($phone)) {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $target_dir = "uploads/photos/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Insert the new user into the database with the photo path
                $stmt = $conn->prepare("INSERT INTO students (cin, name, email, password, gender, phone, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $cin, $name, $email, $hashedPassword, $gender, $phone, $target_file);

                if ($stmt->execute()) {
                    $success = "Registration successful. You can now <a href='login.php'>login</a>.";
                } else {
                    $error = "Error: " . $stmt->error;
                }
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }
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
.password {
    grid-column: span 2; /* Make the password div span both columns */
}
.show-hide {
    cursor: pointer;
    margin-left: 10px;
    color: #007bff;
}
</style>    

<body>
    <div class="login-container">
        <div class="logo">
            <img src="logo (2).png" alt="logo">
        </div>
        <h2>Sign Up</h2>
        <form method="post" action="" enctype="multipart/form-data">
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
                <div class="phone">
                    <label for="phone">Phone Number</label>
                    <div class="input-container">
                        <ion-icon name="call-outline"></ion-icon>
                        <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    </div>
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <div class="input-container">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" placeholder="Enter Password" required>
                        <span class="show-hide" onclick="togglePasswordVisibility()">Show</span>
                    </div>
                </div>
                
            </div>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>

            <button type="submit" class="login">Sign In</button>
        </form>
        <div class="footer">
            <span>Already have an account?</span>
            <a href="login.php">Login</a>
        </div>
    </div>
    <script src="script.js"></script>
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
