<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['student_cin'])) {
    header("Location: login.php");
    exit();
}

$student_cin = $_SESSION['student_cin'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meal_type = $_POST['meal_type'];
    $reservation_date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO meal_reservations (student_cin, meal_type, reservation_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_cin, $meal_type, $reservation_date);

    if ($stmt->execute()) {
        echo "Meal reserved!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<form action="reserve_meal.php" method="POST">
    <select name="meal_type">
        <option value="breakfast">Breakfast</option>
        <option value="lunch">Lunch</option>
        <option value="dinner">Dinner</option>
    </select>
    <button type="submit">Reserve Meal</button>
</form>
