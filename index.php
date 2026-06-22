<?php
require 'includes/db.php';

$result = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<header>
    <a href="index.php" class="logo">LOGO</a>
    <a href="dashboard.php" class="admin-link">  
        <i class="fa-solid fa-gear"></i>
    </a>
</header>

<main>
    <h1>Produse</h1>
    <div class="cards-grid">
        <?php while ($p = $result->fetch_assoc()): ?>
        <div class="card">
            <img src="gallery/<?= htmlspecialchars($p['image']) ?>" loading="lazy">
            <div class="card-body">
                <p class="card-title"><?= htmlspecialchars($p['title']) ?></p>
                <p class="card-desc"><?= htmlspecialchars($p['description']) ?></p>
                <p class="card-price"><?= number_format($p['price'], 2) ?> lei</p>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>