<?php
require 'includes/db.php';

$id = $_GET['id'];
$error = '';

$result = $conn->query("SELECT * FROM products WHERE id=$id");
$p = $result->fetch_assoc();

if (!$p) {
    die("Produsul nu a fost găsit.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $image       = $_POST['image'];

    $sql = "UPDATE products SET
                title='$title',
                description='$description',
                price='$price',
                image='$image'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Eroare: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editează produs</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<main>
    

    <?php if ($error): ?>
        <div class="alert alert-error"><?= $error ?></div>
    <?php endif; ?>

    <div class="form-card">
        <h1>Editează produs</h1>
        <form method="post" action="edit.php?id=<?= $id ?>">
            <div class="form-group">
                <label>Titlu</label>
                <input type="text" name="title" value="<?= htmlspecialchars($p['title']) ?>" required>
            </div>
            <div class="form-group">
                <label>Descriere</label>
                <textarea name="description" required><?= htmlspecialchars($p['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Preț (lei)</label>
                <input type="number" name="price" step="0.01" value="<?= $p['price'] ?>" required>
            </div>
            <div class="form-group">
                <label>Nume fișier imagine</label>
                <input type="text" name="image" value="<?= htmlspecialchars($p['image']) ?>" placeholder="poza1.png" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Salvează</button>
                <a href="dashboard.php" class="btn btn-ghost">Anulează</a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
