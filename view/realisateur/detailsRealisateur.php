<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DU REALISATEUR</h1>
</div>

<div class="card">
    <div class="cardImage">
        <img src="<?= ($realisateur["img"]) ?>" alt="Photo de <?= ($realisateur["prenom"]) ?> <?= ($realisateur["nom"]) ?>">
    </div>
    <div class="cardInfo">
        <div class="cardText">
            <div class="cardTextTitre">
                <p><?= ($realisateur["prenom"]) ?> <?= ($realisateur["nom"]) ?></p>
            </div>
            <p>Née le : <em><?= ($realisateur["dateNaissance"]) ?></em></p>
        </div>
    </div>
</div>
<div class="textUnderCard">
    <p><?= nl2br($realisateur["biographie"]) ?></p>
</div>

<div class="titreSecondaire">
    <h2>FILMOGRAPHIE</h2>
</div>
<?php
foreach ($nbFilms as $film) 
{
?>
    <div class="mediaList">
        <div class="mediaListImg">
            <img src="<?= ($film["img"]) ?>" alt="">
        </div>
        <div class="mediaListInfo">
            <p><b><?= ($film["titre"]) ?></b> (<?= ($film["anneeSortie"]) ?>)</p>
        </div>
    </div>

<?php
}

// Prépare les variables pour le template 
$titre = "Détails Réalisateur";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>