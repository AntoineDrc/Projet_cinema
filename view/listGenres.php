<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES GENRES</h1>
</div>

<?php
// Boucle sur chaque genre récupéré de la base de données.
foreach ($genres as $genre)
{
    $detailsUrl = "index.php?action=detailsGenre&id=" . $genre['id_categorie'];
?>
    <div class="genres">
        <div class="genreImg">
            <a href="<?= $detailsUrl ?>">
                <img src="<?= $genre["img"]?>" alt=""></a>
        </div>
        <div class="genreInfo">
            <a href="<?= $detailsUrl ?>">
                <p><?= $genre["genre"]?></p></a>
        </div>
    </div>
<?php
}
?>


<?php
// Prépare les variables pour le template 
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>