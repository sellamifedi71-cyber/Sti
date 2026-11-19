<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: droit-form.php');
    exit;
}
verify_csrf();

$userId = strtoupper(trim($_POST['id'] ?? ''));
$documentId = strtoupper(trim($_POST['doc'] ?? ''));
$write = isset($_POST['ecriture']) ? 'O' : 'N';
$read = isset($_POST['lecture']) ? 'O' : 'N';
$print = isset($_POST['impression']) ? 'O' : 'N';

if (!preg_match('/^U[0-9]{3}$/', $userId) || !preg_match('/^D[0-9]{4}$/', $documentId)) {
    http_response_code(422);
    exit('Identifiant utilisateur ou document invalide.');
}
if ($read !== 'O' && ($write === 'O' || $print === 'O')) {
    http_response_code(422);
    exit('Les droits écriture et impression nécessitent le droit lecture.');
}

$userCheck = $cnx->prepare('SELECT 1 FROM utilisateur WHERE idUtil = ?');
$userCheck->bind_param('s', $userId);
$userCheck->execute();
if (!$userCheck->get_result()->fetch_row()) {
    http_response_code(404);
    exit('Utilisateur inexistant.');
}
$documentCheck = $cnx->prepare('SELECT 1 FROM document WHERE idDoc = ?');
$documentCheck->bind_param('s', $documentId);
$documentCheck->execute();
if (!$documentCheck->get_result()->fetch_row()) {
    http_response_code(404);
    exit('Document inexistant.');
}

$stmt = $cnx->prepare(
    'INSERT INTO droit (iddoc, idutil, ecriture, lecture, impression) VALUES (?, ?, ?, ?, ?) '
    . 'ON DUPLICATE KEY UPDATE ecriture = VALUES(ecriture), lecture = VALUES(lecture), impression = VALUES(impression)'
);
$stmt->bind_param('sssss', $documentId, $userId, $write, $read, $print);
$stmt->execute();
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Droits enregistrés</title><link rel="stylesheet" href="mesStyles.css"></head><body><main class="container"><p class="success">Les droits d'accès ont été enregistrés.</p><p><a href="droit.html">Attribuer d'autres droits</a> · <a href="affichage.html">Consulter les droits</a> · <a href="index.html">Accueil</a></p></main></body></html>
