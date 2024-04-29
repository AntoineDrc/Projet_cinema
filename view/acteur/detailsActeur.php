<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DE L'ACTEUR, BIOGRAPHIE ET FILMOGRAPHIE</h1>
</div>

<div class="card">
    <div class="cardImage">
        <img src="<?= ($acteur["img"]) ?>" alt="Photo de <?= ($acteur["prenom"]) ?> <?= ($acteur["nom"]) ?>">
    </div>
    <div class="cardInfo">
        <div class="cardText">
            <div class="cardTextTitre">
                <p><?= ($acteur["prenom"]) ?> <?= ($acteur["nom"]) ?></p>
            </div>
            <p>Née le : <em><?= ($acteur["dateNaissance"]) ?></em></p>
        </div>
    </div>
</div>
<div class="textUnderCard">
    <p><?= nl2br($acteur["biographie"]) ?></p>
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
            <img src="<?= ($film["img"]) ?>" alt="Jaquette de <?= $film['titre'] ?>">
        </div>
        <div class="mediaListInfo">
            <p><b><?= ($film["titre"]) ?></b> (<?= ($film["anneeSortie"]) ?>)</p>
            <p>Rôle : <em><?= ($film["nomPersonnage"]) ?></em></p>
            <p>Durée : <?= ($film["duree"]) ?></p>
        </div>
    </div>
<?php
}
?>

<?php
// Prépare les variables pour le template 
$titre = "Détails Acteur";
$titre_secondaire = "Liste des acteurs";
$meta = "Biographie détaillée de l'acteur, ainsi que sa filmographie complète.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>