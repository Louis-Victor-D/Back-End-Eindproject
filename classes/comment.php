<?php
include_once(__DIR__ . '/../classes/init.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "Niet ingelogd"]);
    exit;
}

if (empty($_POST['comment']) || empty($_POST['product_id'])) {
    echo json_encode(["success" => false, "error" => "Lege invoer"]);
    exit;
}

$stmt = $connect->prepare("
    INSERT INTO reviews (product_id, user_id, comment)
    VALUES (?, ?, ?)
");

$stmt->execute([
    $_POST['product_id'],
    $_SESSION['user_id'],
    $_POST['comment']
]);

echo json_encode([
    "success" => true,
    "comment" => htmlspecialchars($_POST['comment'])
]);