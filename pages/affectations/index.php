<?php
require_once __DIR__ . "/../../config/database.php";
$data = $pdo->query("
    SELECT a.*, c.nom_classe, CONCAT(e.nom, ' ', e.prenom) AS nom_enseignant, m.nom_matiere
    FROM affectation a
    JOIN classe c ON c.id_classe = a.id_classe
    JOIN enseignant e ON e.id_enseignant = a.id_enseignant
    JOIN matiere m ON m.id_matiere = a.id_matiere
    ORDER BY c.nom_classe
")->fetchAll(PDO::FETCH_ASSOC);
$base = "/gestion_scolaire/"; $pageTitle = "Affectations"; $pageIcon = "🔗"; $pageDesc = "Enseignants affectés aux classes et matières"; $activePage = "affectations";
include __DIR__ . "/../../includes/header.php";
?>
<div class="page-header"><div></div><a href="create.php" class="btn btn-primary">➕ Nouvelle affectation</a></div>
<div class="card">
    <div class="card-head"><h3>🔗 Liste des affectations <span class="badge badge-red"><?= count($data) ?></span></h3></div>
    <div class="table-wrap">
    <?php if(empty($data)): ?>
    <div class="empty-state"><div class="es-icon">🔗</div><h3>Aucune affectation</h3><p><a href="create.php" style="color:var(--primary)">Créer une affectation</a></p></div>
    <?php else: ?>
    <table>
        <thead><tr><th>Classe</th><th>Enseignant</th><th>Matière</th><th>Année scolaire</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach($data as $d): ?>
        <tr>
            <td><span class="badge badge-purple"><?= htmlspecialchars($d['nom_classe']) ?></span></td>
            <td><div style="display:flex;align-items:center;gap:9px;">
                <div class="avatar" style="background:#ede9fe;color:#6d28d9"><?= mb_substr($d['nom_enseignant'],0,1) ?></div>
                <?= htmlspecialchars($d['nom_enseignant']) ?>
            </div></td>
            <td><span class="badge badge-orange"><?= htmlspecialchars($d['nom_matiere']) ?></span></td>
            <td><?= htmlspecialchars($d['anne_scolaire'] ?? '—') ?></td>
            <td><div class="actions">
                <a class="action-edit" href="edit.php?id=<?= $d['id_affectation'] ?>">✏️ Modifier</a>
                <span class="action-sep">|</span>
                <a class="action-del" href="delete.php?id=<?= $d['id_affectation'] ?>" onclick="return confirm('Supprimer ?')">🗑 Supprimer</a>
            </div></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
