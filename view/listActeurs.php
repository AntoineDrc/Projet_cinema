<?php ob_start(); ?>

<!-- HTML pour afficher le nombre d'acteurs récupérés. -->
<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>

<!-- Tableau HTML pour lister les acteurs. -->
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>PRENOM</th>
            <th>NOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Boucle sur chaque acteur récupéré de la base de données.
        foreach($requete->fetchAll() as $personne)
        {
        ?>
            <tr>
                <td><?= $personne["prenom"] ?></td>
                <td><?= $personne["nom"] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
// Prépare les variables pour le template 
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>