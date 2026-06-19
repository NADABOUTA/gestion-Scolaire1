<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM classe WHERE id_classe=?"); $stmt->execute([$id]); $c = $stmt->fetch();
if (!$c) { header("Location: index.php"); exit; }
if ($_POST) {
    $pdo->prepare("UPDATE classe SET nom_classe=?, niveau=? WHERE id_classe=?")->execute([$_POST['nom_classe'], $_POST['niveau'], $id]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Modifier la classe"; $pageIcon = "✏️"; $activePage = "classes";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>✏️ Modifier — <span class="badge badge-purple"><?= htmlspecialchars($c['nom_classe']) ?></span></h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Nom de la classe</label><input type="text" name="nom_classe" required value="<?= htmlspecialchars($c['nom_classe']) ?>"></div>
                <div class="form-group"><label>Niveau</label><input type="text" name="niveau" required value="<?= htmlspecialchars($c['niveau']) ?>"></div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
