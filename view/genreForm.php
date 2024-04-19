<?php ob_start(); ?>

        <form action="/addGenreForm" method="post">
            <label for="Genre">Genre :</label>
            <input type="text" name="nom">
            <input type="submit" value="Ajouter le genre">
        </form>
        

<?php
// Prépare les variables pour le template 
$titre = "Ajouter Genre";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>