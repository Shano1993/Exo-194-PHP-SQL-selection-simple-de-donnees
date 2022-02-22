<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>

<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */

try {
    $server = 'localhost';
    $user = 'root';
    $db = 'base_exo194';
    $password = '';

    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt1 = $pdo->prepare("SELECT nom, prenom, rue, numero, code_postal, ville, pays, mail FROM user");

    $state1 = $stmt1->execute();

    if ($state1) {
        foreach ($stmt1->fetchAll() as $user) { ?>
            <div id="user">
                <p><?="Nom : " . $user['nom'] ?></p>
                <p><?="Prénom : " . $user['prenom'] ?></p>
                <p><?="Rue : " . $user['rue'] ?></p>
                <p><?="Numéro : " . $user['numero'] ?></p>
                <p><?="Code Postal : " . $user['code_postal'] ?></p>
                <p><?="Ville : " . $user['ville'] ?></p>
                <p><?="Pays : " . $user['pays'] ?></p>
                <p><?="Mail : " . $user['mail'] ?></p>
            </div> <?php
        }
    }

    $stmt2 = $pdo->prepare("SELECT * FROM user ORDER BY id DESC");

    $state2 = $stmt2->execute();

    if ($state2) {
        foreach ($stmt2->fetchAll() as $user) { ?>
            <div id="desc">
                <p><?="ID : " . $user['id'] ?></p>
                <p><?="Nom : " . $user['nom'] ?></p>
                <p><?="Prénom : " . $user['prenom'] ?></p>
                <p><?="Rue : " . $user['rue'] ?></p>
                <p><?="Numéro : " . $user['numero'] ?></p>
                <p><?="Code Postal : " . $user['code_postal'] ?></p>
                <p><?="Ville : " . $user['ville'] ?></p>
                <p><?="Pays : " . $user['pays'] ?></p>
                <p><?="Mail : " . $user['mail'] ?></p>
            </div> <?php
        }
    }

    $stmt3 = $pdo->prepare("SELECT * FROM user ORDER BY prenom DESC, nom DESC");

    $state3 = $stmt3->execute();

    if ($state3) {
        foreach ($stmt3->fetchAll() as $user) { ?>
            <div id="name">
                <p><?="Nom : " . $user['nom'] ?></p>
                <p><?="Prénom : " . $user['prenom'] ?></p>
            </div> <?php
        }
    }
}
catch (Exception $exception) {
    echo $exception->getMessage();
}
