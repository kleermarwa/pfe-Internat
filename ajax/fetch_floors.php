<?php
include '../connection.php';

if (isset($_GET['dorm_id'])) {
    $dorm_id = $_GET['dorm_id'];

    $query = $conn->prepare("SELECT DISTINCT floor FROM rooms WHERE dorm_id = ?");
    $query->bind_param("i", $dorm_id);
    $query->execute();
    $result = $query->get_result();

    $floors = [];
    while ($row = $result->fetch_assoc()) {
        $floors[] = $row['floor'];
    }

    echo json_encode($floors);
}
?>
