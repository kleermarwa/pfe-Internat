<?php
session_start();
include '../db.php'; // Ensure correct database connection

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch search query if available
$search_query = isset($_GET['search']) ? trim($_GET['search']) : "";

// Prepare SQL query for student search
$total_students_query = "SELECT * FROM students" . ($search_query ? " WHERE cin LIKE ? OR name LIKE ?" : "");
$stmt = $conn->prepare($total_students_query);

if ($search_query) {
    $search_term = "%$search_query%";
    $stmt->bind_param("ss", $search_term, $search_term);
}

$stmt->execute();
$total_students = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'internat</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Gestion d'internat</h1>
    </header>
    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="profile.jpg" alt="User Picture" class="profile-picture">
            <p class="username"><?php echo $_SESSION['username']; ?></p>
        </div>
        <hr>
        <nav id="nav-bar">
            <div class="sidebar-buttons">
                <button class="sidebar-button"><i class="fa-solid fa-building"></i><span> Gestion des internats</span></button>
                <button class="sidebar-button"><i class="fa-solid fa-door-open"></i><span> Gestion des chambres</span></button>
                <button class="sidebar-button"><i class="fa-solid fa-file"></i><span> Demandes d'internat</span></button>
                <button class="sidebar-button"><i class="fa-solid fa-face-sad-tear"></i><span> Réclamations</span></button>
            </div>
        </nav>
        <button class="logout-button" onclick="window.location.href='logout.php'"><i class="fa-solid fa-sign-out-alt"></i><span> Logout</span></button>
    </div>
    
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    
    <div class="main-content">
        <div class="buttons">
            <button class="big-button">Internat filles</button>
            <button class="big-button">Internat garçons</button>
        </div>

        <!-- Student Search & List Section -->
        <div class="students-table">
            <h2>Students List</h2>

            <!-- Search Bar -->
            <form method="GET" action="" class="mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by CIN or Name" 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
            </form>

            <table border="1">
                <thead>
                    <tr>
                        <th>CIN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($student = $total_students->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['cin']); ?></td>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                        <td><?php echo htmlspecialchars($student['gender']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($student['photo']); ?>" alt="Student Photo" width="50"></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
