<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    exit("Not logged in");
}

$name = $_POST['name'];
$email = $_POST['email'];
$position = $_POST['position'];
$salary = $_POST['salary'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    INSERT INTO employees (name,email,position,salary,user_id)
    VALUES (:name,:email,:position,:salary,:uid)
");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':position', $position);
$stmt->bindValue(':salary', $salary);
$stmt->bindValue(':uid', $user_id);
$stmt->execute();

header("Location: dashboard.php");
exit;
