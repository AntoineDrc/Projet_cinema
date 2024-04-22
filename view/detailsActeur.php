<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DE L'ACTEUR</h1>
</div>
<div class="acteurDetails">
    <div class="acteurPhoto">
        <img src="<?= ($detailsActeur["img"]) ?>" alt="">
    </div>
    <div class="acteurInfo">
        <p><?= ($detailsActeur["prenom"]) ?></p>
        <p><?= ($detailsActeur["nom"]) ?></p>
        <p>née le : <?= ($detailsActeur["dateNaissance"]) ?></p>
    </div>
</div>
<div class="biographie">
    <p>Biographie :<br><br><?= ($detailsActeur["biographie"]) ?></p>
</div>

<?php
// Prépare les variables pour le template 
$titre = "Détails Acteur";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>