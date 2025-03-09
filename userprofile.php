<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'student') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

$name = $user['name'];
$email = $user['email'];
$phone = $user['phone'];
$photo = $user['photo'];
$gender = $user['gender'];
$date_naissance = $user['date_naissance'];
$pays = $user['pays'];
$ville = $user['ville'];
$room = $user['room'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['photo'])) {
    $target_dir = "uploads/photos/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Update the user's photo path in the database
            $stmt = $conn->prepare("UPDATE students SET photo = ? WHERE email = ?");
            $stmt->bind_param("ss", $target_file, $username);
            if ($stmt->execute()) {
                // Insert the photo path into the student_photos table
                $stmt = $conn->prepare("INSERT INTO student_photos (student_cin, photo_path) VALUES (?, ?)
                                        ON DUPLICATE KEY UPDATE photo_path = VALUES(photo_path)");
                $stmt->bind_param("ss", $user['cin'], $target_file);
                $stmt->execute();
                echo "The file ". htmlspecialchars(basename($_FILES["photo"]["name"])). " has been uploaded.";
                $photo = $target_file; // Update the photo variable to reflect the new photo
            } else {
                echo "Error updating record: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #141460;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .profile-img {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background: #141460;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Mon Profil</h2>
        <img class="profile-img" src="<?php echo htmlspecialchars($photo); ?>" alt="Photo de profil">
        <table>
            <tr><td><strong>Nom Complet:</strong></td><td><?php echo htmlspecialchars($name); ?></td></tr>
            <tr><td><strong>Email:</strong></td><td><?php echo htmlspecialchars($email); ?></td></tr>
            <tr><td><strong>Téléphone:</strong></td><td><?php echo htmlspecialchars($phone); ?></td></tr>
            <tr><td><strong>Date de Naissance:</strong></td><td><?php echo htmlspecialchars($date_naissance); ?></td></tr>
            <tr><td><strong>Pays:</strong></td><td><?php echo htmlspecialchars($pays); ?></td></tr>
            <?php if (!empty($ville)) : ?><tr><td><strong>Ville:</strong></td><td><?php echo htmlspecialchars($ville); ?></td></tr><?php endif; ?>
            <?php if (!empty($room)) : ?><tr><td><strong>Chambre:</strong></td><td><?php echo htmlspecialchars($room); ?></td></tr><?php endif; ?>
        </table>
        <form action="userprofile.php" method="post" enctype="multipart/form-data">
            <label for="photo">Change Profile Picture:</label>
            <input type="file" name="photo" id="photo">
            <button type="submit">Upload</button>
        </form>
        <a class="btn" href="../includes/updateProfile.php">Modifier Profil</a>
    </div>
</body>
</html>
