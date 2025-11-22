<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$stmt = $conn->prepare("SELECT * FROM employees WHERE user_id = :uid ORDER BY id DESC");
$stmt->bindValue(':uid', $user_id);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h2>Welcome, <?= $user_name ?> 👋</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="container">
    <h3>Your Employees</h3>
    <a class="add-btn" href="add_employee.php">+ Add Employee</a>

    <table class="emp-table">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Position</th><th>Salary</th><th>Actions</th>
        </tr>

        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['id'] ?></td>
            <td><?= htmlspecialchars($emp['name']) ?></td>
            <td><?= htmlspecialchars($emp['email']) ?></td>
            <td><?= htmlspecialchars($emp['position']) ?></td>
            <td><?= htmlspecialchars($emp['salary']) ?></td>
            <td>
                <a href="edit_employee.php?id=<?= $emp['id'] ?>">Edit</a>
                <a class="delete" href="delete_employee.php?id=<?= $emp['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
