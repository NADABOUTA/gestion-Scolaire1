<?php
require_once __DIR__ . "/../../config/database.php";
if ($_POST) {
    $pdo->prepare("INSERT INTO classe (nom_classe, niveau) VALUES (?, ?)")->execute([$_POST['nom_classe'], $_POST['niveau']]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Ajouter une classe"; $pageIcon = "➕"; $activePage = "classes";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>📋 Nouvelle classe</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Nom de la classe</label><input type="text" name="nom_classe" required placeholder="ex: 3ème A"></div>
                <div class="form-group"><label>Niveau</label>
                    <select name="niveau" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach(['1ère année','2ème année','3ème année','4ème année','5ème année','6ème année','1ère collège','2ème collège','3ème collège','Tronc commun','1ère Bac','2ème Bac'] as $n): ?>
                        <option value="<?= $n ?>"><?= $n ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">✅ Créer la classe</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
