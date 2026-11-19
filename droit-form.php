<?php
declare(strict_types=1);
require __DIR__ . '/db.php';
?>
<!doctype html>
<html lang="fr">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Attribution des droits d'accès</title><link rel="stylesheet" href="mesStyles.css"><script src="mesControles.js" defer></script></head>
<body><main class="container"><form action="droit.php" method="post" onsubmit="return verif2()"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><fieldset><legend>Attribution des droits d'accès à un document</legend>
<label for="i">Identifiant de l'utilisateur</label><input id="i" name="id" type="text" maxlength="4" pattern="U[0-9]{3}" placeholder="U001" required>
<label for="n">Document</label><select id="n" name="doc" required><option value="">Sélectionner un document</option><option value="D0001">Liste employés.pdf</option><option value="D0002">Demande de congés.docx</option><option value="D0003">Réclamation ouvriers.docx</option><option value="D0004">Statistiques2024.xlsx</option></select>
<span class="field-label">Droits accordés</span><label class="check"><input type="checkbox" name="ecriture" id="ecriture" value="O" onchange="syncRights()"> Écriture</label>
<label class="check"><input type="checkbox" name="lecture" id="lecture" value="O" onchange="syncRights()"> Lecture</label><label class="check"><input type="checkbox" name="impression" id="impression" value="O" onchange="syncRights()"> Impression</label>
<p class="hint">L'écriture et l'impression nécessitent également le droit de lecture.</p><div class="actions"><button type="submit">Enregistrer</button><button type="reset" class="secondary">Annuler</button></div></fieldset></form></main></body></html>
