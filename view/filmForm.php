<?php ob_start(); ?>

<div class="titrePage">
    <h1>AJOUTER UN FILM</h1>
</div>
<div class="formulaire">
    <form action="indexFilm.php?action=addFilm" method="post">
        <div class="entreeFilm">
            <label for="Titre">Titre</label>
            <input type="text" name="titre">
            <label for="Année">Année :</label>
            <input type="text" name="anneeSortie">
            <label for="Durée">Durée</label>
            <input type="text" name="duree">
        </div>

        <!-- Menu déroulant pour selectionner un genre existant -->
        <div class="entreeGenre">
            <label for="ChoixGenre">Choix du genre :</label>
            <select name="genre[]" multiple>
                <option value="">Choisir un genre</option>
                <?php
                
                foreach ($genres as $genre) // Boucle pour afficher les genres
                {
                ?>
                    <option value="<?= $genre["id_categorie"] ?>"><?= $genre["genre"] ?></option>
                <?php
                }
                ?>
            </select><br>
        </div>

        <!-- Menu déroulant pour selectionner un realisateur existant -->
        <div class="entreeRealisateur">
            <label for="ChoixRealisateur">Choix du Realisateur :</label>
            <select name="realisateur">
                <option value="">Choisir un realisateur</option>
                <?php
                foreach ($realisateurs as $realisateur) // Boucle pour afficher les realisateurs
                {
                ?>
                    <option value="<?= $realisateur["id_realisateur"] ?>"><?= $realisateur["prenom"] . " " . $realisateur["nom"] ?></option>
                <?php
                }
                ?>
            </select><br><br>
        </div>

        <input type="submit" value="Ajouter le film">
    </form>
</div>

<?php

// Prépare les variables pour le template 
$titre = "Ajouter Film";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";

?>