<?php
session_start();
include '../db.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin users
$admin_users_query = "SELECT * FROM admin_users";
$admin_users_result = $conn->query($admin_users_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-users-table {
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
        }

        .admin-users-table h2 {
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
        <h1>Admin Users</h1>
    </header>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <div class="admin-users-table">
            <h2>Admin Users List</h2>

            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($admin_user = $admin_users_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($admin_user['id']); ?></td>
                        <td><?php echo htmlspecialchars($admin_user['username']); ?></td>
                        <td><?php echo htmlspecialchars($admin_user['email']); ?></td>
                        <td><?php echo htmlspecialchars($admin_user['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
