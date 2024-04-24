<?php ob_start(); ?>

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

<div class="titreSecondaire">
    <h2>CASTING</h2>
</div>
<div class="filmographie">
    <?php
    foreach ($casting as $acteur) 
    {
    ?>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?= ($acteur["img"]) ?>" alt=""></td>
                    <td><?= ($acteur["prenom"]) ?></td>
                    <td><?= ($acteur["nom"]) ?></td>
                    <td><?= ($acteur["nomPersonnage"]) ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    }
    ?>
</div>


<?php
// Prépare les variables pour le template 
$titre = "Détails Film";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>