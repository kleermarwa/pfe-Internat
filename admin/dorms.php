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
    <title>Gestion des batiments</title>
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
            width: 160px; /* Increased width */
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            width: 20%; /* Adjusted width */
        }

        th {
            background-color: #1e1e6d; /* Changed color */
            color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        table, th, td {
            border: 2px solid #141460;
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
                    <input type="text" class="form-control" name="search" placeholder="Search by dorm building name" 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="search-btn">Search</button>
                </div>
            </form>
        </div>
        <div class="dorms-list" id="dormsList">
            <?php while ($dorm = $dorms_result->fetch_assoc()): ?>
                <div class="dorm" onclick="showModal('dorm<?= $dorm['id'] ?>')">
                    <h3><?= htmlspecialchars($dorm['name']) ?></h3>
                </div>
                <div id="dorm<?= $dorm['id'] ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('dorm<?= $dorm['id'] ?>')">&times;</span>
                        <h3><?= htmlspecialchars($dorm['name']) ?></h3>
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
        function showModal(id) {
            document.getElementById(id).style.display = "block";
        }

        function closeModal(id) {
            document.getElementById(id).style.display = "none";
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
