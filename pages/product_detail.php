<?php
include_once '../classes/db.php';
include_once '../classes/item.php';

$productObj = new Product($connect);

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: product.php");
    exit();
}

$product = $productObj->getOne($id);

if (!$product) {
    die("Product niet gevonden.");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product detail</title>
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
    <h1>Anime Hoodie</h1>
    <img src="" style="max-width:300px;">
    <p>Prijs: €49,99</p>
    <a class="btn" href="#">In winkelmandje</a>
</div>

<div class="comment-section">
    <h3>Reacties</h3>

    <form id="commentForm">
        <textarea name="comment" required></textarea>
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <button type="submit">Plaatsen</button>
    </form>

    <div id="comments">
    </div>
</div>

<footer>&copy; 2025 MangaVerse</footer>
<script>
document.getElementById("commentForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../classes/comment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // ✅ HIER bestaat data
        if (data.success) {
            document.getElementById("comments").innerHTML += `
                <div class="comment">
                    <strong>${data.username}</strong>
                    <p>${data.comment}</p>
                </div>
            `;
            this.reset();
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error("AJAX fout:", error);
    });
});

</script>
</body>
</html>
