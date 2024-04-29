<?php ob_start();
$detailsUrl = "index.php?action=editGenreForm&id=" . $genre['id_categorie'];
?>

<div class="titrePage">
    <h1>DETAILS DU GENRE</h1>
</div>
<div class="card">
    <div class="cardImage">
    <a href="<?= $detailsUrl ?>">
        <img src="<?= ($genre["img"]) ?>" alt="Photo de <?= ($genre["genre"]) ?>"></a>
    </div>
    <div class="cardInfo">
        <div class="cardText">
            <div class="cardTextTitre">
            <a href="<?= $detailsUrl ?>">
                <p><?= ($genre["genre"]) ?></p></a>
            </div>
        </div>
    </div>

</div>

<div class="titreSecondaire">
    <h2>FILMS</h2>
</div>

<?php
foreach ($films as $film) 
{
?>

    <div class="mediaList">
        <div class="mediaListImg">
            <img src="<?= ($film["img"]) ?>" alt="Jaquette de <?= $film['titre'] ?> ">
        </div>
        <div class="mediaListInfo">
            <p><b><?= ($film["titre"]) ?></b> (<?= ($film["anneeSortie"]) ?>)</p>
            <p><em></em></p>
        </div>
    </div>


<?php
}

// Prépare les variables pour le template 
$titre = "Détails du genre";
$titre_secondaire = "";
$meta = "Découvrez la liste des films par genre, comprenant titre et date de sortie.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>