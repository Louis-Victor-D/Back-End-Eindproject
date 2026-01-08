<?php
session_start();
include_once '../classes/db.php';
include_once '../classes/user.php';

$userObj = new User($connect);
$userData = $userObj->find($_SESSION['user_id']); 
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
        <a href="../classes/logout.php" class="btn--logout-link">Uitloggen</a>
    </nav>
</header>

<div class="container">
    <h1>Mijn Profiel</h1>
    <div class="card profile-card">
        <div class="profile-info">
            <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></p>
        </div>
        <div class="button-group">
            <a class="btn btn--primary" href="change_password.php">Wachtwoord wijzigen</a>
            <a class="btn btn--logout" href="../classes/logout.php">Log uit</a>
        </div>
    </div>
</div>

<footer>&copy; 2025 MangaVerse</footer>
</body>
</html>