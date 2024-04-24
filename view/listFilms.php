<?php ob_start(); ?>

<div class="titrePage">
    <h1> FILMS A L'AFFICHE</h1>
</div>
<!-- Tableau HTML pour lister les films. -->
<table class="table">
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
        foreach ($films as $film)
        {
            $imgPath = "public/img/" . $film["titre"] . ".jpg";
            $detailsUrl = "index.php?action=detailsFilm&id=" . $film['id_film'];
        ?>
            <tr>
                <td><a href="<?= $detailsUrl ?>">
                    <img src=<?="$imgPath" ?> alt="Jaquette de ($film['titre'])"></a></td>
                <td><a href="<?= $detailsUrl ?>">
                <td><?= $film["titre"] ?></a></td>
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