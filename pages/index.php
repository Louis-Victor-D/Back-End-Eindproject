<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>MangaVerse</title>
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

<section class="hero">
    <h1>Anime & Manga Merchandise</h1>
    <p>De beste merch op één plek</p>
</section>

<section class="slideshow">
    <h2>🔥 Best Sellers</h2>
    <div class="slider">
        <div class="slide active">
            <img src="../images/placeholder.png">
            <p>Anime Hoodie</p>
        </div>
        <div class="slide">
            <img src="../images/placeholder.png">
            <p>Demon Slayer Beeldje</p>
        </div>
    </div>
</section>

<div class="container">
    <h1>Categorieën</h1>
    <div class="grid">
        <div class="card">Merch</div>
        <div class="card">Figurines</div>
        <div class="card">Manga</div>
        <div class="card">Wapens</div>
    </div>
</div>

<script>
let slides = document.querySelectorAll('.slide');
let i = 0;
setInterval(() => {
    slides[i].classList.remove('active');
    i = (i + 1) % slides.length;
    slides[i].classList.add('active');
}, 3000);
</script>

<footer>&copy; 2025 MangaVerse</footer>
</body>
</html>