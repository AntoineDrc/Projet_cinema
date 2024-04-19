<?php  


$listFilms = $listFilms->fetchAll();
$detailsFilm = $requete->fetch();

ob_start();

?>

<div class="titrePage">
    <h1>DETAILS DU FILM</h1>
</div>

<div class="filmDetails">
        <div class="filmPhoto">
            <img src="<?= ($detailsFilm["img"]) ?>" alt="">
        </div>
        <div class="filmInfo">
            <p><?= ($detailsFilm["titre"]) ?></p>
            <p><?= ($detailsFilm["anneeSortie"]) ?></p>
            <p><?= ($detailsFilm["duree"]) ?></p>
            <p><?= ($detailsFilm["genre"]) ?></p>
            <p><?= ($detailsFilm["prenomRealisateur"]) ?></p>
            <p><?= ($detailsFilm["nomRealisateur"]) ?></p>
            <p><?= ($detailsFilm["acteurs"]) ?></p>
            <div class="note">
                <p><?= ($detailsFilm["note"]) ?></p>
            </div>
        </div>
    </div>

<?php
// Prépare les variables pour le template 
$titre = "Détails Film";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>