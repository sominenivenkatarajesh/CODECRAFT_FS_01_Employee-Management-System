<?php
session_start();
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("
    INSERT INTO users (name,email,password)
    VALUES (:name,:email,:password)
");

$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);

try {
    $stmt->execute();
    header("Location: login.php");
    exit;
} catch (PDOException $e) {
    header("Location: register.php?error=Email already exists");
    exit;
}
