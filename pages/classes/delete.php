<?php
require "../../config/database.php";

$id = $_GET['id'];

$pdo->prepare("DELETE FROM classe WHERE id_classe=?")
    ->execute([$id]);

header("Location: index.php");