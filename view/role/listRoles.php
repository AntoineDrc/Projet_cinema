<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES ROLES</h1>
</div>


<?php
// Boucle sur chaque film récupéré de la base de données.
foreach ($roles as $role) {
    $detailsUrl = "index.php?action=detailsRole&id=" . $role['id_role'];
?>
    <div class="card">
        <div class="cardImage">
            <a href="<?= $detailsUrl ?>">
                <img src=<?= $role['img'] ?> alt="Photo de <?= $role['nomPersonnage'] ?>"></a>
        </div>
        <div class="cardInfo">
            <div class="cardText">
                <div class="cardTextTitre">
                    <p><a href="<?= $detailsUrl ?>">
                            <?= $role["nomPersonnage"] ?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
// Prépare les variables pour le template 
$titre = "Liste des rôles";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>