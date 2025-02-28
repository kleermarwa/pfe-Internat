<?php
include '../connection.php';

if (isset($_GET['dorm_id']) && isset($_GET['floor'])) {
    $dorm_id = $_GET['dorm_id'];
    $floor = $_GET['floor'];

    $roomQuery = $conn->prepare("SELECT room_number, occupied_slots FROM rooms WHERE dorm_id = ? AND floor = ?");
    $roomQuery->bind_param("ii", $dorm_id, $floor);
    $roomQuery->execute();
    $result = $roomQuery->get_result();

    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    echo json_encode($rooms);
}
?>
