<?php
declare(strict_types=1);
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: utilisateur.html');
    exit;
}

$id = strtoupper(trim($_POST['i'] ?? ''));
$name = trim($_POST['np'] ?? '');

if (!preg_match('/^U[0-9]{3}$/', $id) || $name === '' || mb_strlen($name) > 50) {
    http_response_code(422);
    exit('Données invalides. Identifiant attendu : U suivi de 3 chiffres ; nom limité à 50 caractères.');
}

try {
    $stmt = $cnx->prepare('INSERT INTO utilisateur (idUtil, nomPrenom) VALUES (?, ?)');
    $stmt->bind_param('ss', $id, $name);
    $stmt->execute();
    $message = 'Utilisateur ajouté avec succès.';
} catch (mysqli_sql_exception $exception) {
    if ((int)$exception->getCode() === 1062) {
        http_response_code(409);
        exit('Cet identifiant existe déjà.');
    }
    throw $exception;
}
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Ajout utilisateur</title><link rel="stylesheet" href="mesStyles.css"></head><body><main class="container"><p class="success"><?= e($message) ?></p><p><a href="utilisateur.html">Ajouter un autre utilisateur</a> · <a href="index.html">Accueil</a></p></main></body></html>
