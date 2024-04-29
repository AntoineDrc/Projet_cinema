<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES REALISATEURS</h1>
</div>

<?php foreach ($realisateurs as $realisateur) {
    $detailsUrl = "index.php?action=detailsRealisateur&id=" . $realisateur['id_realisateur'];
?>
    <div class="card">
        <div class="cardImage">
            <a href="<?= $detailsUrl ?>">
                <img src=<?= $realisateur['img'] ?> alt="Photo de <?= $realisateur['prenom'] . " " . $realisateur['nom'] ?>"></a>
        </div>
        <div class="cardInfo">
            <div class="cardText">
                <div class="cardTextTitre">
                    <p><a href="<?= $detailsUrl ?>">
                            <?= $realisateur["prenom"] . " " . $realisateur["nom"] ?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php
} ?>

<?php
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$meta = "Explorer notre lise de realisateurs du cinéma mondial.";
$contenu = ob_get_clean();
require "view/template/template.php";
?>