<?php
session_start();
include '../db.php'; // Ensure correct database connection

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
</head>
<body>
    <header class="header">
        <h1>Listes des Chambres</h1>
    </header>
    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture" class="profile-picture">
            <span class="username">User Name</span>
        </div>
        <hr>
        <nav id="nav-bar">
            <div class="sidebar-buttons">
                <a href="#" class="sidebar-button"><i class="fa-solid fa-building"></i><span> Gestion des internats</span></a>
                <a href="roomslist.php" class="sidebar-button"><i class="fa-solid fa-door-open"></i><span> Gestion des chambres</span></a>
                <a href="#" class="sidebar-button"><i class="fa-solid fa-file"></i><span> Demandes d'internat</span></a>
                <a href="#" class="sidebar-button"><i class="fa-solid fa-face-sad-tear"></i><span> Réclamations</span></a>
            </div>
        </nav>
        <a href="logout.php" class="logout-button"><i class="fa-solid fa-sign-out-alt"></i><span> Logout</span></a>
    </div>
    
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    
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
