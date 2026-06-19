<?php
require_once __DIR__ . "/config/database.php";

$eleves       = $pdo->query("SELECT COUNT(*) FROM eleve")->fetchColumn();
$classes      = $pdo->query("SELECT COUNT(*) FROM classe")->fetchColumn();
$enseignants  = $pdo->query("SELECT COUNT(*) FROM enseignant")->fetchColumn();
$matieres     = $pdo->query("SELECT COUNT(*) FROM matiere")->fetchColumn();
$inscriptions = $pdo->query("SELECT COUNT(*) FROM inscription")->fetchColumn();
$affectations = $pdo->query("SELECT COUNT(*) FROM affectation")->fetchColumn();

$base       = "/gestion_scolaire/";
$pageTitle  = "Tableau de bord";
$pageIcon   = "📊";
$pageDesc   = "Vue d'ensemble du système scolaire";
$activePage = "dashboard";

include __DIR__ . "/includes/header.php";
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon si-blue">👨‍🎓</div>
        <div class="stat-info">
            <div class="stat-value"><?= $eleves ?></div>
            <div class="stat-label">Élèves</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-purple">🏫</div>
        <div class="stat-info">
            <div class="stat-value"><?= $classes ?></div>
            <div class="stat-label">Classes</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-green">👨‍🏫</div>
        <div class="stat-info">
            <div class="stat-value"><?= $enseignants ?></div>
            <div class="stat-label">Enseignants</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-orange">📚</div>
        <div class="stat-info">
            <div class="stat-value"><?= $matieres ?></div>
            <div class="stat-label">Matières</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-teal">📝</div>
        <div class="stat-info">
            <div class="stat-value"><?= $inscriptions ?></div>
            <div class="stat-label">Inscriptions</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon si-red">🔗</div>
        <div class="stat-info">
            <div class="stat-value"><?= $affectations ?></div>
            <div class="stat-label">Affectations</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <h3> Accès rapide</h3>
    </div>
    <div class="card-body" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
        <a href="<?= $base ?>pages/eleves/create.php" class="btn btn-primary">➕ Nouvel élève</a>
        <a href="<?= $base ?>pages/enseignants/index.php" class="btn btn-outline">👨‍🏫 Enseignants</a>
        <a href="<?= $base ?>pages/inscriptions/create.php" class="btn btn-success">📝 Nouvelle inscription</a>
        <a href="<?= $base ?>pages/affectations/create.php" class="btn btn-outline">🔗 Nouvelle affectation</a>
    </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>