<?php
$conn = new mysqli("localhost", "root", "", "crud_example");

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}
?>
