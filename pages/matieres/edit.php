<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM matiere WHERE id_matiere=?"); $stmt->execute([$id]); $m = $stmt->fetch();
if (!$m) { header("Location: index.php"); exit; }
if ($_POST) {
    $pdo->prepare("UPDATE matiere SET nom_matiere=? WHERE id_matiere=?")->execute([$_POST['nom_matiere'], $id]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Modifier la matière"; $activePage = "matieres";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head">
        <h3> Modifier — <span class="badge badge-orange"><?= htmlspecialchars($m['nom_matiere']) ?></span></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group" style="max-width:400px">
                <label>Nom de la matière</label>
                <input type="text" name="nom_matiere" required value="<?= htmlspecialchars($m['nom_matiere']) ?>">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"> Enregistrer</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>