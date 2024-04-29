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
    <div class="card">
        <div class="cardImage">
            <a href="<?= $detailsUrl ?>">
                <img src=<?= $genre['img'] ?> alt="Photo de <?= $genre['genre'] ?>"></a>
        </div>
        <div class="cardInfo">
            <div class="cardText">
                <div class="cardTextTitre">
                    <p><a href="<?= $detailsUrl ?>">
                            <?= $genre["genre"] ?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<?php
// Prépare les variables pour le template 
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$meta = "Explorer notre liste de genres de films. Action, comédie, drame, horreur, science-fiction, thriller, etc.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>