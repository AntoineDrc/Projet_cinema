<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS ROLE</h1>
</div>
<div class="personneDetails">
    <div class="personnePhoto">
        <img src="<?= ($detailsRole["img"]) ?>" alt="">
    </div>
    <div class="personneInfo">
        <p><?= ($detailsRole["titre"]) ?></p>
        <p><?= ($detailsRole["nomPersonnage"]) ?></p>
        <p><?= ($detailsRole["nomComplet"]) ?></p>
    </div>
</div>


<?php
// Prépare les variables pour le template 
$titre = "Détails Role";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>