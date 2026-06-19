<?php
require_once __DIR__ . "/../../config/database.php";

$id = $_GET['id'] ?? null;

if ($id) {

    try {
        $stmt = $pdo->prepare("DELETE FROM matiere WHERE id_matiere = ?");
        $stmt->execute([$id]);

    } catch (PDOException $e) {
        die("Impossible de supprimer cette matière (utilisée dans une affectation)");
    }
}

header("Location: index.php");
exit;