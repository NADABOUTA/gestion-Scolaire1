<?php
require_once __DIR__ . "/../../config/database.php";
$classes = $pdo->query("SELECT * FROM classe ORDER BY niveau, nom_classe")->fetchAll(PDO::FETCH_ASSOC);
$base = "/gestion_scolaire/"; $pageTitle = "Classes"; $pageIcon = "🏫"; $pageDesc = "Gestion des classes"; $activePage = "classes";
include __DIR__ . "/../../includes/header.php";
?>
<div class="page-header"><div></div><a href="create.php" class="btn btn-primary">➕ Ajouter une classe</a></div>
<div class="card">
    <div class="card-head"><h3>🏫 Liste des classes <span class="badge badge-purple"><?= count($classes) ?></span></h3></div>
    <div class="table-wrap">
    <?php if(empty($classes)): ?>
    <div class="empty-state"><div class="es-icon">🏫</div><h3>Aucune classe</h3><p><a href="create.php" style="color:var(--primary)">Créer une classe</a></p></div>
    <?php else: ?>
    <table>
        <thead><tr><th>ID</th><th>Nom de la classe</th><th>Niveau</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach($classes as $c): ?>
        <tr>
            <td><span class="td-mono"><?= $c['id_classe'] ?></span></td>
            <td><strong><?= htmlspecialchars($c['nom_classe']) ?></strong></td>
            <td><span class="badge badge-purple"><?= htmlspecialchars($c['niveau']) ?></span></td>
            <td><div class="actions">
                <a class="action-edit" href="edit.php?id=<?= $c['id_classe'] ?>">✏️ Modifier</a>
                <span class="action-sep">|</span>
                <a class="action-del" href="delete.php?id=<?= $c['id_classe'] ?>" onclick="return confirm('Supprimer cette classe ?')">🗑 Supprimer</a>
            </div></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>
