<?php
require_once __DIR__ . "/../../config/database.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM enseignant WHERE id_enseignant = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;