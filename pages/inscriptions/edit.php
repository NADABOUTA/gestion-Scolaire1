<?php
require_once __DIR__ . "/../../config/database.php";
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM inscription WHERE id_inscription=?");
$stmt->execute([$id]);
$inscription = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$inscription) { header("Location: index.php"); exit; }
$eleves  = $pdo->query("SELECT * FROM eleve ORDER BY nom")->fetchAll();
$classes = $pdo->query("SELECT * FROM classe ORDER BY nom_classe")->fetchAll();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo->prepare("UPDATE inscription SET matricule_eleve=?, id_classe=?, Date_d_inscription=? WHERE id_inscription=?")
        ->execute([$_POST['matricule'], $_POST['classe'], $_POST['date'], $id]);
    header("Location: index.php"); exit;
}
$base = "/gestion_scolaire/"; $pageTitle = "Modifier l'inscription"; $pageIcon = "✏️"; $activePage = "inscriptions";
include __DIR__ . "/../../includes/header.php";
?>
<div class="card">
    <div class="card-head"><h3>✏️ Modifier l'inscription <span class="badge badge-teal">#<?= $id ?></span></h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group"><label>Élève</label>
                    <select name="matricule" required>
                    <?php foreach($eleves as $e): ?>
                    <option value="<?= $e['matricule_eleve'] ?>" <?= $e['matricule_eleve']==$inscription['matricule_eleve']?'selected':'' ?>>
                        <?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?>
                    </option>
                    <?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Classe</label>
                    <select name="classe" required>
                    <?php foreach($classes as $c): ?>
                    <option value="<?= $c['id_classe'] ?>" <?= $c['id_classe']==$inscription['id_classe']?'selected':'' ?>>
                        <?= htmlspecialchars($c['nom_classe']) ?>
                    </option>
                    <?php endforeach; ?>
                    </select></div>
                <div class="form-group"><label>Date d'inscription</label>
                    <input type="date" name="date" required value="<?= htmlspecialchars($inscription['Date_d_inscription']) ?>">
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
