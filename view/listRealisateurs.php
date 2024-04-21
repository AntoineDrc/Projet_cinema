<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES REALISATEURS</h1>
</div>

<?php foreach ($realisateurs as $realisateur) 
{ ?>
    <div class="realisateurs">
        <div class="realisateurImg">
            <img src="<?= $realisateur["img"]?>" alt="">
        </div>
        <div class="realisateurInfo">
            <p><?= $realisateur["prenom"]?></p>
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