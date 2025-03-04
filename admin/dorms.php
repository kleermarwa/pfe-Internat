<?php
include '../db.php'; 
include 'sidebar.php';
// Fetch dorms data
$dorms_query = "SELECT * FROM dorms";
$dorms_result = $conn->query($dorms_query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bâtiments des Dortoirs</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script defer src="script.js"></script>
    <style>
        .dorms-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .dorm {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 360px; /* Increased width */
            cursor: pointer;
            margin-left: 20px;
            transition: transform 0.3s;
        }

        .dorm:hover {
            transform: translateY(-5px);
        }

        .dorm h3 {
            margin: 0;
            color: #141460;
        }

        .rooms {
            display: none;
            margin-top: 10px;
        }

        .rooms.show {
            display: block;
        }

        .rooms p {
            margin: 5px 0;
            padding: 10px;
            background: #f0f2f5;
            border-radius: 5px;
        }

        .form-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #1950a4cb;
            outline: none;
        }
    </style>
</head>
<body>
<header class="header">
        <h1>Gestion des batiments</h1>
    </header>    
        <div class="main-content">
        <div class="form-group">
        <form method="GET" action="" class="mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by CIN or Name" 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="search-btn">Search</button>
                </div>
            </form>
        </div>
        <div class="dorms-list" id="dormsList">
            <?php while ($dorm = $dorms_result->fetch_assoc()): ?>
                <div class="dorm" onclick="toggleRooms('dorm<?= $dorm['id'] ?>')">
                    <h3><?= htmlspecialchars($dorm['name']) ?></h3>
                    <div class="rooms" id="dorm<?= $dorm['id'] ?>">
                        <table>
                            <thead>
                                <tr>
                                    <th>Num Chambre</th>
                                    <th>Étage</th>
                                    <th>Capacité</th>
                                    <th>Places Occupées</th>
                                    <th>Remplissage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rooms_query = "SELECT room_number, floor, capacity, occupied_slots FROM rooms WHERE dorm_id = " . $dorm['id'];
                                $rooms_result = $conn->query($rooms_query);
                                while ($room = $rooms_result->fetch_assoc()):
                                    $fullness = ($room['occupied_slots'] / $room['capacity']) * 100;
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($room['room_number']) ?></td>
                                        <td><?= htmlspecialchars($room['floor']) ?></td>
                                        <td><?= htmlspecialchars($room['capacity']) ?></td>
                                        <td><?= htmlspecialchars($room['occupied_slots']) ?></td>
                                        <td><?= htmlspecialchars(number_format($fullness, 2)) ?>%</td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <script>
        function toggleRooms(id) {
            document.getElementById(id).classList.toggle("show");
        }

        function toggleSidebar() {
            document.querySelector(".sidebar").classList.toggle("open");
        }

        function filterDorms() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const dorms = document.querySelectorAll('.dorm');

            dorms.forEach(dorm => {
                const dormName = dorm.querySelector('h3').textContent.toLowerCase();
                if (dormName.includes(searchInput)) {
                    dorm.style.display = 'block';
                } else {
                    dorm.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
