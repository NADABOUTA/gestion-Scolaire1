<?php
require_once __DIR__ . "/../../config/database.php";
$data = $pdo->query("
    SELECT inscription.*, eleve.nom AS nom_eleve, eleve.prenom AS prenom_eleve, classe.nom_classe
    FROM inscription
    JOIN eleve ON eleve.matricule_eleve = inscription.matricule_eleve
    JOIN classe ON classe.id_classe = inscription.id_classe
    ORDER BY inscription.id_inscription DESC
")->fetchAll(PDO::FETCH_ASSOC);
$base = "/gestion_scolaire/"; $pageTitle = "Inscriptions"; $pageIcon = "📝"; $pageDesc = "Gestion des inscriptions"; $activePage = "inscriptions";
include __DIR__ . "/../../includes/header.php";
?>
<div class="page-header"><div></div><a href="create.php" class="btn btn-success">➕ Nouvelle inscription</a></div>
<div class="card">
    <div class="card-head"><h3>📝 Liste des inscriptions <span class="badge badge-teal"><?= count($data) ?></span></h3></div>
    <div class="table-wrap">
    <?php if(empty($data)): ?>
    <div class="empty-state"><div class="es-icon">📝</div><h3>Aucune inscription</h3><p><a href="create.php" style="color:var(--primary)">Créer une inscription</a></p></div>
    <?php else: ?>
    <table>
        <thead><tr><th>ID</th><th>Élève</th><th>Classe</th><th>Date d'inscription</th></tr></thead>
        <tbody>
        <?php foreach($data as $d): ?>
        <tr>
            <td><span class="td-mono">#<?= $d['id_inscription'] ?></span></td>
            <td><div style="display:flex;align-items:center;gap:9px;">
                <div class="avatar" style="background:#ccfbf1;color:#0f766e"><?= mb_substr($d['nom_eleve'],0,1) ?><?= mb_substr($d['prenom_eleve'],0,1) ?></div>
                <div><?= htmlspecialchars($d['nom_eleve'].' '.$d['prenom_eleve']) ?></div>
            </div></td>
            <td><span class="badge badge-purple"><?= htmlspecialchars($d['nom_classe']) ?></span></td>
            <td><?= htmlspecialchars($d['Date_d_inscription']) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
