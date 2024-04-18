<?php  

$listActeurs = $listActeurs->fetchAll();
$detailsActeur = $requete->fetch();

ob_start();

?>

<h1>DETAILS DE L'ACTEUR</h1>
<div class="acteurDetails">
      
        <img src="public/image/<?= ($detailsActeur["nom"]) ?>.jpg" alt="">
        <p><?= ($detailsActeur["prenom"]) ?></p>
        <p><?= ($detailsActeur["nom"]) ?></p>
        <p><?= ($detailsActeur["sexe"]) ?></p>
        <p><?= ($detailsActeur["dateNaissance"]) ?></p>
        <p><?= ($detailsActeur["biographie"]) ?></p>
    <?php
    

    ?>
</div>

<?php
// Prépare les variables pour le template 
$titre = "Détails Acteur";
$titre_secondaire = "Liste des acteurs";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>