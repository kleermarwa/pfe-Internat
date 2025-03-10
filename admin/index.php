
<?php
session_start();
include '../db.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
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
    <style>
        .students-table {
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        .students-table h2 {
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

 

        td img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #141460;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Gestion d'internat</h1>
    </header>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <!-- Student Search & List Section -->
        <div class="students-table">
            <h2>Students List</h2>

            <!-- Search Bar -->
            <form method="GET" action="" class="mb-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by CIN or Name" 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="search-btn">Search</button>
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
