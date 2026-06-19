<?php
require_once __DIR__ . "/../../config/database.php";

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $stmt = $pdo->prepare("INSERT INTO eleve (matricule_eleve, nom, prenom, date_naissance, adresse, telephone) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['matricule_eleve'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse'], $_POST['telephone']]);
        header("Location: index.php"); exit;
    } catch (PDOException $e) {
        $error = "Erreur : matricule déjà existant ou données invalides.";
    }
}

$base = "/gestion_scolaire/"; $pageTitle = "Ajouter un élève"; $pageIcon = "➕"; $activePage = "eleves";
include __DIR__ . "/../../includes/header.php";
?>

<?php if ($error): ?><div class="alert alert-danger">⚠️ <?= $error ?></div><?php endif; ?>

<div class="card">
    <div class="card-head"><h3>📋 Informations de l'élève</h3></div>
    <div class="card-body">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Matricule</label>
                    <input type="text" name="matricule_eleve" required placeholder="ex: EL2024001" value="<?= htmlspecialchars($_POST['matricule_eleve'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" required placeholder="Nom de famille" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom" required placeholder="Prénom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Date de naissance</label>
                    <input type="date" name="date_naissance" required value="<?= htmlspecialchars($_POST['date_naissance'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" placeholder="Adresse complète" value="<?= htmlspecialchars($_POST['adresse'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" placeholder="06 XX XX XX XX" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">✅ Ajouter l'élève</button>
                <a href="index.php" class="btn btn-outline">← Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . "/../../includes/footer.php"; ?>
