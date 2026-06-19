<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM enseignant WHERE id_enseignant=?"); $stmt->execute([$id]); $e = $stmt->fetch();
if (!$e) { header("Location: index.php"); exit; }
if ($_POST) {
    $pdo->prepare("UPDATE enseignant SET nom=?, prenom=?, telephone=? WHERE id_enseignant=?")->execute([$_POST['nom'], $_POST['prenom'], $_POST['telephone'], $id]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Modifier l'enseignant"; $pageIcon = "✏️"; $activePage = "enseignants";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>✏️ Modifier — <span class="badge badge-green"><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></span></h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Nom</label><input type="text" name="nom" required value="<?= htmlspecialchars($e['nom']) ?>"></div>
                <div class="form-group"><label>Prénom</label><input type="text" name="prenom" required value="<?= htmlspecialchars($e['prenom']) ?>"></div>
                <div class="form-group"><label>Téléphone</label><input type="tel" name="telephone" value="<?= htmlspecialchars($e['telephone']) ?>"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
