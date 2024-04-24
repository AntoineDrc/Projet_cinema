<?php ob_start();
$detailsUrl = "index.php?action=editGenreForm&id=" . $detailsGenre['id_categorie'];
?>

<div class="titrePage">
    <h1>DETAILS DU GENRE</h1>
</div>

<div class="genreDetails">
    <div class="genrePhoto">
        <a href="<?= $detailsUrl ?>">
            <img src="<?= ($detailsGenre["img"]) ?>" alt=""></a>
    </div>
    <div class="genreInfo">
        <a href="<?= $detailsUrl ?>">
        <p><?= ($detailsGenre["genre"]) ?></p></a>
    </div>
</div>

<div class="titreSecondaire">
    <h2>FILMS</h2>
</div>




<?php
// Prépare les variables pour le template 
$titre = "Détails du genre";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>