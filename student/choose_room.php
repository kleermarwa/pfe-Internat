<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['student_cin'])) {
    header("Location: login.php");
    exit();
}

$student_cin = $_SESSION['student_cin'];
$genderQuery = $conn->prepare("SELECT gender FROM students WHERE cin = ?");
$genderQuery->bind_param("s", $student_cin);
$genderQuery->execute();
$result = $genderQuery->get_result();
$student = $result->fetch_assoc();
$gender = $student['gender'];

$dormQuery = $conn->prepare("SELECT * FROM dorms WHERE gender = ?");
$dormQuery->bind_param("s", $gender);
$dormQuery->execute();
$dormResult = $dormQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Room</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Select Your Room</h2>

        <form action="reserve_room.php" method="POST">
            <label for="dorm">Choose Dorm:</label>
            <select name="dorm_id" id="dorm" onchange="fetchFloors()">
                <option value="">Select Dorm</option>
                <?php while ($dorm = $dormResult->fetch_assoc()): ?>
                    <option value="<?php echo $dorm['id']; ?>"><?php echo $dorm['name']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="floor">Choose Floor:</label>
            <select name="floor" id="floor" onchange="fetchRooms()">
                <option value="">Select Floor</option>
            </select>

            <label for="room">Choose Room:</label>
            <div id="room-list"></div>

            <input type="hidden" name="room_number" id="selected-room">
            <button type="submit">Reserve Room</button>
        </form>
    </div>

    <script src="../js/room-selection.js"></script>
</body>
</html>
