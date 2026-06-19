<?php
require_once __DIR__ . "/../../config/database.php";
$ens = $pdo->query("SELECT * FROM enseignant ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);
$base = "/gestion_scolaire/"; $pageTitle = "Enseignants"; $pageIcon = "👨‍🏫"; $pageDesc = "Gestion du corps enseignant"; $activePage = "enseignants";
include __DIR__ . "/../../includes/header.php";
?>
<div class="page-header"><div></div><a href="create.php" class="btn btn-primary">➕ Ajouter un enseignant</a></div>
<div class="card">
    <div class="card-head"><h3>👨‍🏫 Liste des enseignants <span class="badge badge-green"><?= count($ens) ?></span></h3></div>
    <div class="table-wrap">
    <?php if(empty($ens)): ?>
    <div class="empty-state"><div class="es-icon">👨‍🏫</div><h3>Aucun enseignant</h3><p><a href="create.php" style="color:var(--primary)">Ajouter un enseignant</a></p></div>
    <?php else: ?>
    <table>
        <thead><tr><th>ID</th><th>Enseignant</th><th>Téléphone</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach($ens as $e): ?>
        <tr>
            <td><span class="td-mono"><?= $e['id_enseignant'] ?></span></td>
            <td><div style="display:flex;align-items:center;gap:9px;">
                <div class="avatar" style="background:#d1fae5;color:#065f46"><?= mb_substr($e['nom'],0,1) ?><?= mb_substr($e['prenom'],0,1) ?></div>
                <div><div style="font-weight:600"><?= htmlspecialchars($e['nom'].' '.$e['prenom']) ?></div></div>
            </div></td>
            <td><?= htmlspecialchars($e['telephone']) ?></td>
            <td><div class="actions">
                <a class="action-edit" href="edit.php?id=<?= $e['id_enseignant'] ?>">✏️ Modifier</a>
                <span class="action-sep">|</span>
                <a class="action-del" href="delete.php?id=<?= $e['id_enseignant'] ?>" onclick="return confirm('Supprimer ?')">🗑 Supprimer</a>
            </div></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
