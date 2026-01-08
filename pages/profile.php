<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../classes/db.php';
include_once '../classes/user.php';

$userObj = new User($connect);
$userData = $userObj->find($_SESSION['user_id']); // Fetches all user data including balance
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Profiel - MangaVerse</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <div class="logo">MangaVerse</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="product.php">Shop</a>
        <a href="profile.php">Profiel</a>
        <a href="logout.php" class="btn--logout-link">Uitloggen</a>
    </nav>
</header>

<div class="container">
    <div class="profile-header">
        <h1>Mijn Account</h1>
    </div>

    <div class="card profile-card">
        <div class="profile-info">
            <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></p>
            
            <div class="balance-section">
                <p>Beschikbaar Saldo</p>
                <h2>
                    €<?= number_format($userData['balance'], 2, ',', '.') ?>
                </h2>
            </div>
            
            <p><strong>Rol:</strong> <?= ucfirst(htmlspecialchars($userData['role'])) ?></p>
        </div>
        
        <div class="button-group">
            <a class="btn btn--primary" href="change_password.php">Wachtwoord wijzigen</a>
            <a class="btn btn--logout" href="logout.php">Log uit</a>
        </div>
    </div>
</div>

<footer>&copy; 2025 MangaVerse</footer>
</body>
</html>