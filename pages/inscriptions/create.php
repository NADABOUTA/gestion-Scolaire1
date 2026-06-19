<?php
require_once __DIR__ . "/../../config/database.php";
$eleves  = $pdo->query("SELECT * FROM eleve ORDER BY nom")->fetchAll();
$classes = $pdo->query("SELECT * FROM classe ORDER BY nom_classe")->fetchAll();
if ($_POST) {
    $pdo->prepare("INSERT INTO inscription (matricule_eleve, id_classe, Date_d_inscription) VALUES (?, ?, ?)")->execute([$_POST['matricule'], $_POST['classe'], $_POST['date']]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Nouvelle inscription"; $pageIcon = "📝"; $activePage = "inscriptions";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>📝 Inscrire un élève</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Élève</label>
                    <select name="matricule" required>
                        <option value="">-- Sélectionner un élève --</option>
                        <?php foreach($eleves as $e): ?>
                        <option value="<?= $e['matricule_eleve'] ?>"><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Classe</label>
                    <select name="classe" required>
                        <option value="">-- Sélectionner une classe --</option>
                        <?php foreach($classes as $c): ?>
                        <option value="<?= $c['id_classe'] ?>"><?= htmlspecialchars($c['nom_classe']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date d'inscription</label>
                    <input type="date" name="date" required value="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">✅ Inscrire</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
