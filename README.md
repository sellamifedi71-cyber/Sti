# STI — Gestion des droits d'accès aux documents

Application pédagogique en HTML, CSS, JavaScript, PHP et MySQL/MariaDB permettant d'ajouter des utilisateurs, d'attribuer des droits de lecture/écriture/impression et de consulter les droits par document.

## Installation locale

1. Installer XAMPP, WAMP ou Laragon avec PHP 8+ et MySQL/MariaDB.
2. Créer/importer la base `bacfedi` avec le fichier `bacfedi.sql` fourni à la racine du dépôt.
3. Vérifier les identifiants de connexion dans `db.php` (`localhost`, `root`, mot de passe vide par défaut dans XAMPP).
4. Placer le projet dans le dossier web local (par exemple `htdocs/Sti`).
5. Ouvrir `http://localhost/Sti/`.

## Fonctionnalités

- Ajout d'utilisateurs avec identifiants `U` suivis de trois chiffres.
- Attribution et mise à jour des droits pour les documents `D0001` à `D0004`.
- Consultation des droits par document.
- La lecture est automatiquement requise pour l'écriture ou l'impression.

## Sécurité et validation

Les traitements PHP valident les entrées côté serveur, utilisent des requêtes préparées et échappent les données affichées en HTML. Les validations JavaScript améliorent l'expérience utilisateur mais ne remplacent pas les contrôles serveur.

## Configuration

Adaptez les paramètres `$host`, `$user`, `$password` et `$database` dans `db.php` à votre environnement. N'utilisez pas les identifiants par défaut sur un serveur public.
