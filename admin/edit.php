<?php
include_once(__DIR__ . '/admin_only.php');
include_once(__DIR__ . '/../classes/item.php');

$product = new Product($connect);
$item = $product->getById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product->update(
        $_GET['id'],
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

<link rel="stylesheet" href="admin.css">
<form method="POST" class="edit-form">
    <h2>Product Bewerken</h2>

    <label for="title">Titel</label>
    <input type="text" name="title" id="title" 
           value="<?= htmlspecialchars($item['title']) ?>" required>

    <label for="description">Beschrijving</label>
    <textarea name="description" id="description"><?= htmlspecialchars($item['descirption']) ?></textarea>

    <label for="price">Prijs (€)</label>
    <input type="number" step="0.01" name="price" id="price" 
           value="<?= $item['price'] ?>" required>

    <label for="category_id">Categorie ID</label>
    <input type="number" name="category_id" id="category_id" 
           value="<?= $item['category_id'] ?>" required>

    <label for="image">Afbeelding URL</label>
    <input type="text" name="image" id="image" 
           value="<?= htmlspecialchars($item['image']) ?>">

    <div class="button-group">
        <button type="submit" class="btn-save">Opslaan</button>
        <a href="overview.php" class="btn-cancel">Annuleren</a>
    </div>
</form>