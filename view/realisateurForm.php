<?php ob_start(); ?>

<div class="titrePage">
    <h1>AJOUTER UN REALISATEUR</h1>
</div>

<div class="formulaire">
    <form action="index.php?action=addRealisateur" method="post" class="entreeRealisateur">
        <label for="Prenom">Prénom</label>
        <input type="text" name="prenom">
        <label for="Nom">Nom :</label>
        <input type="text" name="nom">
        <label for="Sexe">Sexe</label>
        <input type="text" name="sexe">
        <label for="DateNaissance">Date de naissance</label>
        <input type="text" name="dateNaissance">
        <input type="submit" value="Ajouter Réalisateur">
    </form>
</div>

<?php
// Prépare les variables pour le template
$titre = "Ajouter Realisateur";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Appelle le template
require "view/template.php";
?>