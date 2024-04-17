<?php ob_start(); ?>

<div class="titrePage">
    <h1>TOUT LES ACTEURS</h1>
</div>
<!-- Tableau HTML pour lister les acteurs. -->
<table class="tableActeurs">
    <tbody>
        <?php
        // Boucle sur chaque acteur récupéré de la base de données.
        foreach($requete->fetchAll() as $personne)
        {
            $imgPath = "public/img/" . $personne["nom"] . ".jpg";
            $detailsUrl = "index.php?action=detailsActeur&id_acteur=" . $personne['id_acteur'];
        ?>
            <tr>
                <td><a href="<?= $detailsUrl ?>">
                    <img src=<?="$imgPath" ?> alt="Photo de <?= $personne['prenom'] ?>"></a></td>
                <td><a href="<?= $detailsUrl ?>">
                    <?= $personne["prenom"] ?></a></td>
                <td><a href="<?= $detailsUrl ?>">
                    <?= $personne["nom"] ?></a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
// Prépare les variables pour le template 
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>