<?php
require_once __DIR__ . "/../../config/database.php";

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM eleve WHERE matricule_eleve=?");
$stmt->execute([$id]);
$e = $stmt->fetch();
if (!$e) { header("Location: index.php"); exit; }

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE eleve SET nom=?, prenom=?, date_naissance=?, adresse=?, telephone=? WHERE matricule_eleve=?");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse'], $_POST['telephone'], $id]);
    header("Location: index.php"); exit;
}

$base = "/gestion_scolaire/"; $pageTitle = "Modifier l'élève"; $pageIcon = "✏️"; $activePage = "eleves";
include __DIR__ . "/../../includes/header.php";
?>

<div class="card">
    <div class="card-head">
        <h3>✏️ Modifier — <span class="badge badge-blue"><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></span></h3>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" required value="<?= htmlspecialchars($e['nom']) ?>">
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom" required value="<?= htmlspecialchars($e['prenom']) ?>">
                </div>
                <div class="form-group">
                    <label>Date de naissance</label>
                    <input type="date" name="date_naissance" value="<?= htmlspecialchars($e['date_naissance']) ?>">
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" value="<?= htmlspecialchars($e['adresse']) ?>">
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" value="<?= htmlspecialchars($e['telephone']) ?>">
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
