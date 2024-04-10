<?php ob_start(); ?>

<div class="bannerTop">
    <h1>RETROUVEZ NOTRE SELECTION DE FILMS</h1>
</div>
<figure>
    <div class="carousselTop">
        <img id="film1" src="../public/img/inception.jpg" alt="jaquette du film Inception">
        <img  id="film2" src="../public/img/lalaland.jpg" alt="jaquette du film lalaland">
    </div>
</figure>

<?php
// Prépare les variables pour le template 
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenuFooter = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>