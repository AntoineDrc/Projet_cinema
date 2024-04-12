<?php ob_start(); ?>

<div class="bannerTop">
    <h5>RETROUVEZ NOTRE SELECTION DE FILMS</h5>
</div>
<figure>
    <div class="carousselTop">
        <img id="film1" src="public/img/inception.jpg" alt="jaquette du film Inception">
        <img  id="film2" src="public/img/lalaland.jpg" alt="jaquette du film lalaland">
    </div>
</figure>
<div class="bannerBot">
    <h5>PAR GENRES</h5>
</div>
<figure>
    <div class="carousselBot">
        <img src="public/img/horreur.jpg" alt="">
        <img src="public/img/comediesMusicales.jpg" alt="">
        <img src="public/img/scienceFiction.jpg" alt="">
    </div>
</figure>

<?php
// Prépare les variables pour le template 
$titre = "Accueil";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>