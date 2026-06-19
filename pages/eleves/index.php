<?php
require_once __DIR__ . "/../../config/database.php";

$eleves = $pdo->query("SELECT * FROM eleve ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

$base       = "/gestion_scolaire/";
$pageTitle  = "Élèves";
$pageIcon   = "👨‍🎓";
$pageDesc   = "Gestion de la liste des élèves";
$activePage = "eleves";

include __DIR__ . "/../../includes/header.php";
?>

<div class="page-header">
    <div></div>
    <a href="create.php" class="btn btn-primary">➕ Ajouter un élève</a>
</div>

<div class="card">
    <div class="card-head">
        <h3>👨‍🎓 Liste des élèves <span class="badge badge-blue"><?= count($eleves) ?></span></h3>
    </div>
    <div class="table-wrap">
        <?php if (empty($eleves)): ?>
        <div class="empty-state">
            <div class="es-icon">👨‍🎓</div>
            <h3>Aucun élève enregistré</h3>
            <p>Commencez par <a href="create.php" style="color:var(--primary)">ajouter un élève</a>.</p>
        </div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Élève</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eleves as $e): ?>
                <tr>
                    <td><span class="td-mono"><?= htmlspecialchars($e['matricule_eleve']) ?></span></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:9px;">
                            <div class="avatar"><?= mb_substr($e['nom'],0,1) ?><?= mb_substr($e['prenom'],0,1) ?></div>
                            <div>
                                <div style="font-weight:600"><?= htmlspecialchars($e['nom']) ?> <?= htmlspecialchars($e['prenom']) ?></div>
                            </div>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($e['date_naissance']) ?></td>
                    <td><?= htmlspecialchars($e['adresse']) ?></td>
                    <td><?= htmlspecialchars($e['telephone']) ?></td>
                    <td>
                        <div class="actions">
                            <a class="action-edit" href="edit.php?id=<?= $e['matricule_eleve'] ?>">✏️ Modifier</a>
                            <span class="action-sep">|</span>
                            <a class="action-del" href="delete.php?id=<?= $e['matricule_eleve'] ?>"
                               onclick="return confirm('Supprimer cet élève ?')">🗑 Supprimer</a>
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
