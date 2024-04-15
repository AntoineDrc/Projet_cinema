<?php ob_start(); ?>

<div class="titre_listFilms">
    <h1> FILMS A L'AFFICHE</h1>
</div>
<!-- Tableau HTML pour lister les films. -->
<table class="tableFilms">
    <thead>
        <tr>
            <th>JAQUETTE</th>
            <th>TITRE</th>
            <th>ANNEE SORTIE<br></th>
            <th>DUREE</th>
            <th>GENRE</th>
            <th>NOTE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Boucle sur chaque film récupéré de la base de données.
        foreach($requete->fetchAll() as $film)
        {
            $imgPath = "public/img/" . $film["titre"] . ".jpg"
        ?>
            <tr>
                <td> <img src=<?="$imgPath" ?> alt="Jaquette de ($film['titre'])"> </td>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["anneeSortie"] ?></td>
                <td><?= $film["duree"] ?></td>
                <td><?= $film["genre"] ?></td>
                <td><?= $film["note"] ?></td>
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