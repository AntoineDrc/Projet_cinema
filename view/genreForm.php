<?php ob_start(); ?>
<div class="titrePage">
    <h1>AJOUTER UN GENRE</h1>
</div>
<div class="formulaire">
    <form action="index.php?action=addGenre" method="post">
        <label for="Genre">Genre :</label>
        <input type="text" name="nom_genre">
        <input type="submit" value="Ajouter le genre">
    </form>
</div>
<?php

// Prépare les variables pour le template 
$titre = "Ajouter Genre";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>