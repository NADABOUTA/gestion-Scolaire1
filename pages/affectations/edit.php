<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM affectation WHERE id_affectation=?"); $stmt->execute([$id]); $aff = $stmt->fetch();
if (!$aff) { header("Location: index.php"); exit; }
$classes = $pdo->query("SELECT * FROM classe ORDER BY nom_classe")->fetchAll();
$ens     = $pdo->query("SELECT * FROM enseignant ORDER BY nom")->fetchAll();
$mat     = $pdo->query("SELECT * FROM matiere ORDER BY nom_matiere")->fetchAll();
$error = "";
if ($_POST) {
    try {
        $pdo->prepare("UPDATE affectation SET id_classe=?, id_enseignant=?, id_matiere=?, anne_scolaire=? WHERE id_affectation=?")
            ->execute([$_POST['classe'], $_POST['ens'], $_POST['mat'], $_POST['annee'], $id]);
        header("Location: index.php"); exit;
    } catch (PDOException $e) { $error = "Erreur : affectation déjà existante."; }
}
$base = "/gestion_scolaire/"; $pageTitle = "Modifier l'affectation"; $pageIcon = "✏️"; $activePage = "affectations";
include __DIR__ . "/../../includes/header.php";
?>
<?php if($error): ?><div class="alert alert-danger">⚠️ <?= $error ?></div><?php endif; ?>
<div class="card">
    <div class="card-head"><h3>✏️ Modifier l'affectation</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Classe</label>
                    <select name="classe" required>
                    <?php foreach($classes as $c): ?><option value="<?= $c['id_classe'] ?>" <?= $c['id_classe']==$aff['id_classe']?'selected':'' ?>><?= htmlspecialchars($c['nom_classe']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Enseignant</label>
                    <select name="ens" required>
                    <?php foreach($ens as $e): ?><option value="<?= $e['id_enseignant'] ?>" <?= $e['id_enseignant']==$aff['id_enseignant']?'selected':'' ?>><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Matière</label>
                    <select name="mat" required>
                    <?php foreach($mat as $m): ?><option value="<?= $m['id_matiere'] ?>" <?= $m['id_matiere']==$aff['id_matiere']?'selected':'' ?>><?= htmlspecialchars($m['nom_matiere']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Année scolaire</label>
                    <input type="text" name="annee" required value="<?= htmlspecialchars($aff['anne_scolaire'] ?? '') ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
