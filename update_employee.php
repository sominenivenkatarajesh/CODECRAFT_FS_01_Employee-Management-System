<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$id       = $_POST['id'];
$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$position = $_POST['position'];
$salary   = $_POST['salary'];
$user_id  = $_SESSION['user_id'];

$stmt = $conn->prepare("
    UPDATE employees 
    SET name = :name,
        email = :email,
        phone = :phone,
        position = :position,
        salary = :salary
    WHERE id = :id AND user_id = :uid
");

$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':phone', $phone);
$stmt->bindValue(':position', $position);
$stmt->bindValue(':salary', $salary);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':uid', $user_id, PDO::PARAM_INT);
$stmt->execute();

header("Location: dashboard.php?msg=updated");
exit;
