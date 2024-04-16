<?php ob_start(); ?>

<div class="bannerTop">
    <h5>RETROUVEZ NOTRE SELECTION DE FILMS</h5>
</div>
<!-- Swiper pour le carrousel du haut -->
<div class="swiper-container carousselTop">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="public/img/inception.jpg" alt="Jaquette du film Inception"></div>
        <div class="swiper-slide"><img src="public/img/lalaland.jpg" alt="Jaquette du film La La Land"></div>
    </div>
    <div class="swiper-pagination carousselTop-pagination"></div>
    <div class="swiper-button-prev carousselTop-button-prev"></div>
    <div class="swiper-button-next carousselTop-button-next"></div>
</div>

<div class="bannerBot">
    <h5>PAR GENRES</h5>
</div>
<!-- Swiper pour le carrousel du bas -->
<div class="swiper-container carousselBot">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="public/img/horreur.jpg" alt="Genre Horreur"></div>
        <div class="swiper-slide"><img src="public/img/comediesMusicales.jpg" alt="Genre Comédies Musicales"></div>
        <div class="swiper-slide"><img src="public/img/scienceFiction.jpg" alt="Genre Science Fiction"></div>
    </div>
    <div class="swiper-pagination carousselBot-pagination"></div>
    <div class="swiper-button-prev carousselBot-button-prev"></div>
    <div class="swiper-button-next carousselBot-button-next"></div>
</div>

<?php
$titre = "Accueil";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";
?>
