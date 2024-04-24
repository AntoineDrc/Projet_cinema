<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DU REALISATEUR</h1>
</div>

<div class="personneDetails">
    <div class="personnePhoto">
        <img src="<?= ($detailsRealisateur["img"]) ?>" alt="">
    </div>
    <div class="acteurInfo">
        <p><?= ($detailsRealisateur["prenom"]) ?></p>
        <p><?= ($detailsRealisateur["nom"]) ?></p>
        <p>née le : <?= ($detailsRealisateur["dateNaissance"]) ?></p>
    </div>
</div>
<div class="biographie">
    <p>Biographie :<br><br><?= ($detailsRealisateur["biographie"]) ?></p>
</div>

<h2>FILMOGRAPHIE</h2>
<div class="filmographie">
    <?php 
    foreach ($nbFilms as $film)
    {
    ?>
        <table>
            <thead>
                <tr>
                    <th>Jaquette</th>
                    <th>Titre</th>
                    <th>Année</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?= ($film["img"]) ?>" alt=""></td>
                    <td><?= ($film["titre"]) ?></td>
                    <td><?= ($film["anneeSortie"]) ?></td>
                </tr>
        </table>

    
    <?php  
    }
    ?>
    
    
</div>

<?php
// Prépare les variables pour le template 
$titre = "Détails Réalisateur";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>