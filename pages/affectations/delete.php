<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
if ($id) { $pdo->prepare("DELETE FROM affectation WHERE id_affectation=?")->execute([$id]); }
header("Location: index.php"); exit;
