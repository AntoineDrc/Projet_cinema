<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DU FILM, CASTING ET SYNOPSIS</h1>
</div>

<div class="card">
    <div class="cardImage">
        <img src="<?= ($film["img"]) ?>" alt="Jaquette de <?= ($film["titre"]) ?>">
    </div>
    <div class="cardInfo">
        <div class="cardText">
            <div class="cardTextTitre">
                <p><?= ($film["titre"]) ?></p>
            </div>
            <p><em><?= ($film["anneeSortie"]) ?> | <?= ($film["duree"]) ?> | <?= ($film["genre"]) ?></em></p>
            <p>De : <b><?= ($film["realisateur"]) ?></b></p>
        </div>
        <div class="note">
            <p><?= ($film["note"]) ?></p>
            <p><i class="fa-solid fa-star" style="color: #FFD43B;"></i></p>
        </div>
    </div>
</div>
<div class="textUnderCard">
    <p><?= ($film["synopsis"]) ?></p>
</div>

<div class="titreSecondaire">
    <h3>CASTING</h3>
</div>
<?php
foreach ($casting as $acteur) 
{
?>
    <div class="mediaList">
        <div class="mediaListImg">
            <img src="<?= ($acteur["img"]) ?>" alt="Photo de <?= $acteur['nom'] . ' ' . $acteur['prenom'] ?> ">
        </div>
        <div class="mediaListInfo">
            <p>Avec : <b><?= ($acteur["prenom"]) ?> <?= ($acteur["nom"]) ?></b></p>
            <p>Rôle : <em><?= ($acteur["nomPersonnage"]) ?></em></p>
        </div>
    </div>

<?php
}
?>

<?php
// Prépare les variables pour le template 
$titre = "Détails Film";
$titre_secondaire = "Liste des acteurs";
$meta = "Découvrez le casting du film, les acteurs et leurs rôles, ainsi que le synopsis complet.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>