<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS DE L'ACTEUR</h1>
</div>
<div class="personneDetails">
    <div class="personnePhoto">
        <img src="<?= ($detailsActeur["img"]) ?>" alt="">
    </div>
    <div class="acteurInfo">
        <p><?= ($detailsActeur["prenom"]) ?></p>
        <p><?= ($detailsActeur["nom"]) ?></p>
        <p>née le : <?= ($detailsActeur["dateNaissance"]) ?></p>
    </div>
</div>
<div class="biographie">
    <p>Biographie :<br><br><?= ($detailsActeur["biographie"]) ?></p>
</div>

<div class="titreSecondaire">
    <h2>FILMOGRAPHIE</h2>
</div>
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
                    <th>Durée</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?= ($film["img"]) ?>" alt=""></td>
                    <td><?= ($film["titre"]) ?></td>
                    <td><?= ($film["anneeSortie"]) ?></td>
                    <td><?= ($film["duree"]) ?></td>
                    <td><?= ($film["nomPersonnage"]) ?>
                    </td>
                </tr>
        </table>
</div>
<?php
    }
?>

<?php
// Prépare les variables pour le template 
$titre = "Détails Acteur";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>