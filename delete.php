<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $sql = "DELETE FROM products WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
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
    header("Location: dashboard.php");
    exit;
}
?>