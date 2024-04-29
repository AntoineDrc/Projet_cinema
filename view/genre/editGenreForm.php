<?php ob_start(); ?>

<div class="titrePage">
    <h1>MODIFIER UN GENRE</h1>
</div>


<div class="formulaire">
    <form action="index.php?action=editGenre&id=<?= $id_genre ?>" method="post" class="modifGenreForm">
        <label for="Genre">Genre :</label>
        <input type="text" name="genre" id="<?= $genre["id_categorie"] ?> " value="<?= $genre["genre"] ?>">
        <input type="submit" value="Modifier le genre">
    </form>
        
    </div>
</div>

<?php

// Prépare les variables pour le template 
$titre = "Modifier un genre";
$titre_secondaire = "";
$meta = "Modifier un genre de film dans la base de données.";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>