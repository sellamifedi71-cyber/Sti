<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

$documentId = strtoupper(trim($_POST['doc'] ?? $_GET['doc'] ?? ''));
if (!preg_match('/^D[0-9]{4}$/', $documentId)) {
    http_response_code(422);
    exit('Veuillez sélectionner un document valide.');
}

$docStmt = $cnx->prepare('SELECT nomDoc FROM document WHERE idDoc = ?');
$docStmt->bind_param('s', $documentId);
$docStmt->execute();
$document = $docStmt->get_result()->fetch_assoc();
if (!$document) {
    http_response_code(404);
    exit('Document introuvable.');
}

$stmt = $cnx->prepare(
    'SELECT u.idUtil, u.nomPrenom, d.ecriture, d.lecture, d.impression '
    . 'FROM droit d INNER JOIN utilisateur u ON u.idUtil = d.idutil '
    . 'WHERE d.iddoc = ? ORDER BY u.nomPrenom'
);
$stmt->bind_param('s', $documentId);
$stmt->execute();
$rights = $stmt->get_result();
function yesNo(string $value): string { return $value === 'O' ? 'Oui' : 'Non'; }
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Droits du document</title><link rel="stylesheet" href="mesStyles.css"></head><body><main class="container"><h1>Droits d'accès</h1><p>Document : <strong><?= e($document['nomDoc']) ?></strong> (<?= e($documentId) ?>)</p>
<?php if ($rights->num_rows === 0): ?><p>Aucun droit n'a encore été attribué à ce document.</p><?php else: ?><div class="table-wrap"><table><thead><tr><th>Identifiant</th><th>Utilisateur</th><th>Lecture</th><th>Écriture</th><th>Impression</th></tr></thead><tbody>
<?php while ($row = $rights->fetch_assoc()): ?><tr><td><?= e($row['idUtil']) ?></td><td><?= e($row['nomPrenom']) ?></td><td><?= yesNo($row['lecture']) ?></td><td><?= yesNo($row['ecriture']) ?></td><td><?= yesNo($row['impression']) ?></td></tr><?php endwhile; ?>
</tbody></table></div><?php endif; ?><p><a href="affichage.html">Choisir un autre document</a> · <a href="index.html">Accueil</a></p></main></body></html>
