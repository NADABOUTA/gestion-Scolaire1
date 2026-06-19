<?php
require_once __DIR__ . "/../../config/database.php";
$matieres = $pdo->query("SELECT * FROM matiere ORDER BY nom_matiere")->fetchAll(PDO::FETCH_ASSOC);
$base = "/gestion_scolaire/"; $pageTitle = "Matières"; $pageIcon = "📚"; $pageDesc = "Gestion des matières scolaires"; $activePage = "matieres";
include __DIR__ . "/../../includes/header.php";
?>
<div class="page-header">
    <div></div><a href="create.php" class="btn btn-primary">➕ Ajouter une matière</a>
</div>
<div class="card">
    <div class="card-head">
        <h3> Liste des matières <span class="badge badge-orange"><?= count($matieres) ?></span></h3>
    </div>
    <div class="table-wrap">
        <?php if(empty($matieres)): ?>
        <div class="empty-state">
            <div class="es-icon">📚</div>
            <h3>Aucune matière</h3>
            <p><a href="create.php" style="color:var(--primary)">Ajouter une matière</a></p>
        </div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la matière</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($matieres as $m): ?>
                <tr>
                    <td><span class="td-mono"><?= $m['id_matiere'] ?></span></td>
                    <td><strong><?= htmlspecialchars($m['nom_matiere']) ?></strong></td>
                    <td>
                        <div class="actions">
                            <a class="action-edit" href="edit.php?id=<?= $m['id_matiere'] ?>"> Modifier</a>
                            <span class="action-sep">|</span>
                            <a class="action-del" href="delete.php?id=<?= $m['id_matiere'] ?>"
                                onclick="return confirm('Supprimer ?')">Supprimer</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?php include __DIR__ . "/../../includes/footer.php"; ?>