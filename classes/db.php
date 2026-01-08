<?php
$host = 'sql312.infinityfree.com';
$db   = 'mangaversedb';
$user = 'if0_40854685';
$pass = 'Vob55zDcvq';

try {
    $connect = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed");
}