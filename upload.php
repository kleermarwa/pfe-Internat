<?php
include __DIR__ . '/connection.php'; // Include your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $cin = $_POST["cin"]; // Student CIN
    $image = $_FILES["image"];
    $uploadDir = "uploads/photos/"; // Folder where images are stored
    $imageName = basename($image["name"]);
    $targetPath = $uploadDir . $imageName;

    // Move the uploaded file to the uploads/photos directory
    if (move_uploaded_file($image["tmp_name"], $targetPath)) {
        $uploadedAt = date("Y-m-d H:i:s"); // Timestamp

        // Insert into the student_images table
        $stmt = $conn->prepare("INSERT INTO student_images (cin, picture_path, uploaded_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cin, $targetPath, $uploadedAt);

        if ($stmt->execute()) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}
?>
