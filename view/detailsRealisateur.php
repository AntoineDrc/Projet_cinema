<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DU REALISATEUR</h1>
</div>

<div class="realisateurDetails">
    <div class="realisateurPhoto">
        <img src="<?= ($detailsRealisateur["img"]) ?>" alt="">
    </div>
    <div class="acteurInfo">
        <p><?= ($detailsRealisateur["prenom"]) ?></p>
        <p><?= ($detailsRealisateur["nom"]) ?></p>
        <p>née le : <?= ($detailsRealisateur["dateNaissance"]) ?></p>
    </div>
</div>
<div class="biographie">
    <p>Biographie :<br><br><?= ($detailsRealisateur["biographie"]) ?></p>
</div>



<?php
// Prépare les variables pour le template 
$titre = "Détails Réalisateur";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>