<?php ob_start(); ?>

<div class="titrePage">
    <h1>TOUT LES ACTEURS</h1>
</div>
<!-- Tableau HTML pour lister les acteurs. -->
<table class="tableActeurs">
    <tbody>
        <?php foreach($acteurs as $personne): ?>
            <?php
                $imgPath = "public/img/" . $personne["nom"] . ".jpg";
                $detailsUrl = "index.php?action=detailsActeur&id=" . $personne['id_acteur'];
            ?>
            <tr>
                <td><a href="<?= $detailsUrl ?>">
                    <img src="<?= $imgPath ?>" alt="Photo de <?= $personne['prenom'] ?>"></a></td>
                <td><a href="<?= $detailsUrl ?>"><?= $personne["prenom"] ?></a></td>
                <td><a href="<?= $detailsUrl ?>"><?= $personne["nom"] ?></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";
?>
