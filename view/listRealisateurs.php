<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES REALISATEURS</h1>
</div>

<?php foreach ($realisateurs as $realisateur) 
{ 
    $detailsUrl = "index.php?action=detailsRealisateur&id=" . $realisateur['id_realisateur'];
    ?>
    <div class="realisateurs">
        <div class="realisateurImg">
            <a href="<?= $detailsUrl ?>">
                <img src="<?= $realisateur["img"]?>" alt=""></a>
        </div>
        <div class="realisateurInfo">
            <a href="<?= $detailsUrl ?>">
                <p><?= $realisateur["prenom"]?></p></a>
            <a href="<?= $detailsUrl ?>">
                <p><?= $realisateur["nom"]?></p>
        </div>
    </div>
<?php 
} ?>

<?php
$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";
?>