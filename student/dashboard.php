<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['student_cin'])) {
    header("Location: login.php");
    exit();
}

$student_cin = $_SESSION['student_cin'];
$student_name = $_SESSION['student_name'];

// Fetch student’s assigned room
$roomQuery = $conn->prepare("SELECT r.room_number, d.name AS dorm_name, r.floor 
                             FROM room_requests rq
                             JOIN rooms r ON rq.room_number = r.room_number
                             JOIN dorms d ON r.dorm_id = d.id
                             WHERE rq.student_cin = ? AND rq.status = 'accepted'");
$roomQuery->bind_param("s", $student_cin);
$roomQuery->execute();
$roomResult = $roomQuery->get_result();
$room = $roomResult->fetch_assoc();

// Fetch reserved meals
$mealQuery = $conn->prepare("SELECT meal_type, reservation_date 
                             FROM meal_reservations 
                             WHERE student_cin = ? 
                             ORDER BY reservation_date DESC");
$mealQuery->bind_param("s", $student_cin);
$mealQuery->execute();
$mealResult = $mealQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $student_name; ?>!</h2>

        <h3>Your Room</h3>
        <?php if ($room): ?>
            <p><strong>Dorm:</strong> <?php echo $room['dorm_name']; ?></p>
            <p><strong>Floor:</strong> <?php echo $room['floor']; ?></p>
            <p><strong>Room Number:</strong> <?php echo $room['room_number']; ?></p>
        <?php else: ?>
            <p>You have not selected a room yet. <a href="choose-room.php">Choose a room now</a></p>
        <?php endif; ?>

        <h3>Your Meal Reservations</h3>
        <ul>
            <?php while ($meal = $mealResult->fetch_assoc()): ?>
                <li><?php echo ucfirst($meal['meal_type']) . " - " . $meal['reservation_date']; ?></li>
            <?php endwhile; ?>
        </ul>

        <a href="reserve_meal.php">Reserve a Meal</a> |
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
