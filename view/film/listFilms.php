<?php ob_start(); ?>

<div class="titrePage">
    <h1> FILMS A L'AFFICHE</h1>
</div>

<?php
// Boucle sur chaque film récupéré de la base de données.
foreach ($films as $film) 
{
    $detailsUrl = "index.php?action=detailsFilm&id=" . $film['id_film'];
?>
    <div class="card">
        <div class="cardImage">
            <a href="<?= $detailsUrl ?>">
                <img src=<?= $film['img'] ?> alt="Jaquette de ($film['titre'])"></a>
        </div>
        <div class="cardInfo">
            <div class="cardText">
                <div class="cardTextTitre">
                    <p><a href="<?= $detailsUrl ?>">
                            <?= $film["titre"] ?></a></p>
                </div>
                <p><?= $film["anneeSortie"] ?> | <?= $film["duree"] ?></p>
                <p><?= $film["genre"] ?></p>
            </div>
            <div class="note">
                <p><?= $film["note"] ?></p>
                <p><i class="fa-solid fa-star" style="color: #FFD43B;"></i></p>
            </div>
        </div>
    </div>
<?php
}

// Prépare les variables pour le template 
$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$meta = "Explorer notre selection de films tendances. Les dernières sorties, les films les mieux notés et les plus populaires.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>