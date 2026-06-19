<?php
require_once __DIR__ . "/../../config/database.php";
$classes = $pdo->query("SELECT * FROM classe ORDER BY nom_classe")->fetchAll();
$ens     = $pdo->query("SELECT * FROM enseignant ORDER BY nom")->fetchAll();
$mat     = $pdo->query("SELECT * FROM matiere ORDER BY nom_matiere")->fetchAll();
$error   = "";
if ($_POST) {
    try {
        $pdo->prepare("INSERT INTO affectation (id_classe, id_enseignant, id_matiere, anne_scolaire) VALUES (?,?,?,?)")
            ->execute([$_POST['classe'], $_POST['ens'], $_POST['mat'], $_POST['annee']]);
        header("Location: index.php"); exit;
    } catch (PDOException $e) { $error = "Affectation déjà existante ou données invalides."; }
}
$base = "/gestion_scolaire/"; $pageTitle = "Nouvelle affectation"; $pageIcon = "🔗"; $activePage = "affectations";
include __DIR__ . "/../../includes/header.php";
?>
<?php if($error): ?><div class="alert alert-danger">⚠️ <?= $error ?></div><?php endif; ?>
<div class="card">
    <div class="card-head"><h3>🔗 Créer une affectation</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Classe</label>
                    <select name="classe" required><option value="">-- Choisir --</option>
                    <?php foreach($classes as $c): ?><option value="<?= $c['id_classe'] ?>"><?= htmlspecialchars($c['nom_classe']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Enseignant</label>
                    <select name="ens" required><option value="">-- Choisir --</option>
                    <?php foreach($ens as $e): ?><option value="<?= $e['id_enseignant'] ?>"><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Matière</label>
                    <select name="mat" required><option value="">-- Choisir --</option>
                    <?php foreach($mat as $m): ?><option value="<?= $m['id_matiere'] ?>"><?= htmlspecialchars($m['nom_matiere']) ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Année scolaire</label>
                    <input type="text" name="annee" required placeholder="ex: 2024-2025" value="<?= date('Y').'-'.(date('Y')+1) ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">✅ Créer l'affectation</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
