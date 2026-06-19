<?php
require_once __DIR__ . "/../../config/database.php";
if ($_POST) {
    $pdo->prepare("INSERT INTO enseignant (nom, prenom, telephone) VALUES (?, ?, ?)")->execute([$_POST['nom'], $_POST['prenom'], $_POST['telephone']]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Ajouter un enseignant"; $pageIcon = "➕"; $activePage = "enseignants";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>📋 Nouvel enseignant</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Nom</label><input type="text" name="nom" required placeholder="Nom de famille"></div>
                <div class="form-group"><label>Prénom</label><input type="text" name="prenom" required placeholder="Prénom"></div>
                <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" placeholder="06 XX XX XX XX"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">✅ Ajouter</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
