<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php?error=Invalid Employee ID");
    exit;
}

$emp_id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT * FROM employees 
    WHERE id = :id AND user_id = :uid
");
$stmt->bindValue(':id', $emp_id, PDO::PARAM_INT);
$stmt->bindValue(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$emp = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emp) {
    header("Location: dashboard.php?error=Employee Not Found");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<div class="form-box">
    <h2>Edit Employee</h2>

    <form action="update_employee.php" method="POST">

        <input type="hidden" name="id" value="<?= $emp['id'] ?>">

        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($emp['name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($emp['email']) ?>" required>

        <label>Phone</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($emp['phone']) ?>" required>

        <label>Position</label>
        <select name="position" required>
            <option <?= $emp['position']=="Manager"?"selected":""; ?>>Manager</option>
            <option <?= $emp['position']=="Developer"?"selected":""; ?>>Developer</option>
            <option <?= $emp['position']=="Designer"?"selected":""; ?>>Designer</option>
            <option <?= $emp['position']=="Sales"?"selected":""; ?>>Sales</option>
        </select>

        <label>Salary</label>
        <input type="number" name="salary" value="<?= htmlspecialchars($emp['salary']) ?>" required>

        <button class="form-btn" type="submit">Update Employee</button>

    </form>

    <a class="back-btn" href="dashboard.php">Back</a>
</div>

</body>
</html>
