<?php
include_once(__DIR__ . '/admin_only.php');
include_once(__DIR__ . '/../classes/item.php');

$product = new Product($connect);
$products = $product->getAll();
?>
<link rel="stylesheet" href="admin.css">
<div class="container">
    <div class="header-actions">
        <h2>Product Overzicht</h2>
        <a href="add.php" class="btn-add-new">+ Nieuw product</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Prijs</th>
                <th class="text-right">Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($p['title']) ?></strong>
                    </td>
                    <td>€<?= number_format($p['price'], 2, ',', '.') ?></td>
                    <td class="text-right">
                        <a href="edit.php?id=<?= $p['product_id'] ?>" class="action-btn edit-btn" title="Bewerken">✏️</a>
                        <a href="remove.php?id=<?= $p['product_id'] ?>" 
                           class="action-btn delete-btn" 
                           onclick="return confirm('Weet je het zeker?')" title="Verwijderen">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>