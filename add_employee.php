<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Employee</title>
<link rel="stylesheet" href="form.css">
</head>
<body>

<div class="form-box">
    <h2>Add Employee</h2>

    <form action="insert.php" method="POST">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone" required>

        <label>Position</label>
        <select name="position">
            <option>Manager</option>
            <option>Developer</option>
            <option>Designer</option>
            <option>Sales</option>
        </select>

        <label>Salary</label>
        <input type="number" name="salary" required>

        <button class="form-btn" type="submit">Add Employee</button>
    </form>

    <a class="back-btn" href="dashboard.php">Back</a>
</div>

</body>
</html>
