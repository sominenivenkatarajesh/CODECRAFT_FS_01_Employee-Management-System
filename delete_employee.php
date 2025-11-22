<?php
session_start();
require __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php?error=invalid_id");
    exit;
}

$emp_id = (int) $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = :id AND user_id = :uid");
    $stmt->bindValue(':id', $emp_id, PDO::PARAM_INT);
    $stmt->bindValue(':uid', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header("Location: dashboard.php?msg=deleted");
    } else {
        header("Location: dashboard.php?error=not_found");
    }
    exit;
} catch (PDOException $e) {
    echo "Error deleting employee: " . htmlspecialchars($e->getMessage());
    exit;
}
