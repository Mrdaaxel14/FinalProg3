<?php
$cn = new mysqli("localhost", "root", "", "stocklite");

if ($cn->connect_error) {
    die("Error de conexión: " . $cn->connect_error);
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die('ID no válido');
}

$stmt = $cn->prepare("DELETE FROM productos WHERE id = ?");

if (!$stmt) {
    die("Prepare falló: " . $cn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->error) {
    die("Execute falló: " . $stmt->error);
}

$stmt->close();
$cn->close();

header('Location: index.php');
exit;
