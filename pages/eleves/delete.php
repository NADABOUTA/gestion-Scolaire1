<?php
require_once __DIR__ . "/../../config/database.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM eleve WHERE matricule_eleve=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;