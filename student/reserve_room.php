<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['student_cin'])) {
    header("Location: login.php");
    exit();
}

$student_cin = $_SESSION['student_cin'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if student already applied
    $checkQuery = $conn->prepare("SELECT id FROM room_requests WHERE student_cin = ?");
    $checkQuery->bind_param("s", $student_cin);
    $checkQuery->execute();
    $checkQuery->store_result();

    if ($checkQuery->num_rows > 0) {
        echo "You have already applied for a room.";
    } else {
        $stmt = $conn->prepare("INSERT INTO room_requests (student_cin, status) VALUES (?, 'pending')");
        $stmt->bind_param("s", $student_cin);
        if ($stmt->execute()) {
            echo "Room request submitted!";
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    }
    
    $checkQuery->close();
}

$conn->close();
?>

<form action="reserve_room.php" method="POST">
    <button type="submit">Apply for Room</button>
</form>
