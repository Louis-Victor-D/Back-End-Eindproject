<?php
include_once(__DIR__ . '/admin_only.php');
include_once(__DIR__ . '/../classes/item.php');

$product = new Product($connect);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product->create(
        $_POST['title'],
        $_POST['description'],
        $_POST['price'],
        $_POST['category_id'],
        $_POST['image']
    );
    header("Location: overview.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <h2>Nieuw Product Toevoegen</h2>
    <label>Titel</label>
    <input name="title" placeholder="Bijv. Koffiezetapparaat" required>
    <label>Beschrijving</label>
    <textarea name="description" placeholder="Vertel iets over het product..."></textarea>
    <label>Prijs (€)</label>
    <input type="number" step="0.01" name="price" placeholder="0.00" required>
    <label>Categorie ID</label>
    <input type="number" name="category_id" placeholder="Bijv. 1" required>
    <label>Afbeelding URL</label>
    <input name="image" placeholder="images/product.jpg">
    <button type="submit">Product toevoegen</button>
</form>
</form>
</body>
</html>
