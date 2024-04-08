<?php ob_start(); ?>

<!-- HTML pour afficher le nombre de films récupérés. -->
<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<!-- Tableau HTML pour lister les films. -->
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Boucle sur chaque film récupéré de la base de données.
        foreach($requete->fetchAll() as $film)
        {
        ?>
            <tr>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["anneeSortie"] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
// Prépare les variables pour le template 
$titre = "Liste des films";
$titre_secondaire = "Liste des films";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>