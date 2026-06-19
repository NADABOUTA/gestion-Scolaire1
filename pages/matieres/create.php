<?php
require_once __DIR__ . "/../../config/database.php";
if ($_POST) {
    $pdo->prepare("INSERT INTO matiere (nom_matiere) VALUES (?)")->execute([$_POST['nom_matiere']]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Ajouter une matière"; $pageIcon = "➕"; $activePage = "matieres";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head">
        <h3> Nouvelle matière</h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group" style="max-width:400px">
                <label>Nom de la matière</label>
                <input type="text" name="nom_matiere" required placeholder="ex: Mathématiques">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"> Ajouter</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>