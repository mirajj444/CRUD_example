<?php
require 'includes/db.php';

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <a href="index.php" class="logo">🛍 Magazin</a>
    <a href="index.php" class="admin-link"><i class="fa-solid fa-arrow-left"></i></a>
</header>

<main>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'success'): ?>
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> Produsul a fost șters cu succes!
        </div>
    <?php endif; ?>

    <div class="toolbar">
        <h1>Dashboard</h1>
        <a href="create.php" class="btn btn-success">+ Produs nou</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:60px">ID</th>
                    <th style="width:80px">Imagine</th>
                    <th>Titlu</th>
                    <th style="width:140px">Preț</th>
                    <th style="width:140px">Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td>
                        <img src="gallery/<?= htmlspecialchars($p['image']) ?>" 
                             class="thumb" >
                    </td>
                    <td><?= htmlspecialchars($p['title']) ?></td>
                    <td><?= number_format($p['price'], 2) ?> lei</td>
                    <td style="white-space:nowrap;">
                        <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        
                        <form action="delete.php" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete „<?= htmlspecialchars($p['title'], ENT_QUOTES) ?>”?');">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>