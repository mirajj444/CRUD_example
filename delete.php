<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validăm și curățăm ID-ul primit din formular pentru siguranță de bază
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $sql = "DELETE FROM products WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Redirecționare înapoi în dashboard cu mesaj de succes
            header("Location: dashboard.php?msg=success");
            exit;
        } else {
            echo "Eroare la ștergerea produsului: " . $conn->error;
        }
    } else {
        die("ID invalid.");
    }

    $conn->close();
} else {
    // Dacă pagina este accesată direct prin GET, redirecționăm înapoi în dashboard
    header("Location: dashboard.php");
    exit;
}
?>