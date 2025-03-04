<?php
session_start();
include '../db.php'; 
include 'sidebar.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch room and student information
$rooms_query = "SELECT rooms.room_number, rooms.floor, rooms.capacity, rooms.occupied_slots, students.cin, students.name 
                FROM rooms 
                LEFT JOIN students ON rooms.room_number = students.room_number
                ORDER BY rooms.room_number, students.cin";
$rooms_result = $conn->query($rooms_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes des Chambres</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .rooms-table {
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        .rooms-table h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #141460;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        thead {
            background: #141460;
            color: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Listes des Chambres</h1>
    </header>

    <div class="main-content">
        <div class="rooms-table">
            <h2>Rooms List</h2>

            <table border="1">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Floor</th>
                        <th>Capacity</th>
                        <th>Occupied Slots</th>
                        <th>Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_room = null;
                    $students = [];
                    while ($row = $rooms_result->fetch_assoc()) {
                        if ($current_room !== $row['room_number']) {
                            if ($current_room !== null) {
                                echo "<td>" . implode(", ", $students) . "</td></tr>";
                            }
                            $current_room = $row['room_number'];
                            $students = [];
                            echo "<tr>
                                    <td>{$row['room_number']}</td>
                                    <td>{$row['floor']}</td>
                                    <td>{$row['capacity']}</td>
                                    <td>{$row['occupied_slots']}</td>";
                        }
                        if ($row['cin']) {
                            $students[] = "{$row['name']} ({$row['cin']})";
                        }
                    }
                    if ($current_room !== null) {
                        echo "<td>" . implode(", ", $students) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
