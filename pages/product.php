<?php
include_once '../classes/db.php';
include_once '../classes/item.php';

$productObj = new Product($connect);

// Get filter values from the URL (GET)
$category = $_GET['category'] ?? null;
$search = $_GET['search'] ?? null;

// Fetch products based on filters
$products = $productObj->getFiltered($category, $search);

// Fetch categories for the dropdown (You can add a getCategories method to your class too!)
$catStmt = $connect->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Shop - MangaVerse</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <div class="logo">MangaVerse</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="product.php">Shop</a>
        <a href="orders.php">Bestellingen</a>
        <a href="profile.php">Profiel</a>
    </nav>
</header>

<div class="container">
    <h1>Onze Producten</h1>

    <form method="GET" class="filter-bar">
        <input type="text" name="search" placeholder="Zoek op naam..." value="<?= htmlspecialchars($search ?? '') ?>">
        
        <select name="category">
            <option value="">Alle Categorieën</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['category_id'] ?>" <?= $category == $cat['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn--primary">Filteren</button>
        <a href="product.php" class="btn-clear">Reset</a>
    </form>

    <div class="grid">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $p): ?>
                <div class="card">
                    <img src="../images/<?= htmlspecialchars($p['image'] ?? 'placeholder.png') ?>" alt="<?= htmlspecialchars($p['title']) ?>">
                    <h3><?= htmlspecialchars($p['title']) ?></h3>
                    <p class="price">€<?= number_format($p['price'], 2, ',', '.') ?></p>
                    <a class="btn" href="product_detail.php?id=<?= $p['product_id'] ?>">Bekijk</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen producten gevonden die aan je zoekopdracht voldoen.</p>
        <?php endif; ?>
    </div>
</div>

<footer>&copy; 2025 MangaVerse</footer>
</body>
</html>