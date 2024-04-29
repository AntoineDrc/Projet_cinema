<?php ob_start(); ?>

<div class="titrePage">
    <h1>LISTE DES ACTEURS</h1>
</div>

<?php
foreach ($acteurs as $personne) 
{
    $detailsUrl = "index.php?action=detailsActeur&id=" . $personne['id_acteur'];
?>
    <div class="card">
        <div class="cardImage">
            <a href="<?= $detailsUrl ?>">
                <img src=<?= $personne['img'] ?> alt="Photo de <?= $personne['prenom'] . " " . $personne['nom'] ?>"></a>
        </div>
        <div class="cardInfo">
            <div class="cardText">
                <div class="cardTextTitre">
                    <p><a href="<?= $detailsUrl ?>">
                            <?= $personne["prenom"] . " " . $personne["nom"] ?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php
}

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$meta = "Explorer notre lise d'acteurs du cinéma mondial.";
$contenu = ob_get_clean();
require "view/template/template.php";
?>