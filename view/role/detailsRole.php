<?php ob_start(); ?>

<div class="titrePage">
    <h1>DETAILS ROLE</h1>
</div>

<div class="card">
    <div class="cardImage">
        <img src="<?= ($role["img"]) ?>" alt="Photo de <?= ($role["nomPersonnage"]) ?>">
    </div>
    <div class="cardInfo">
        <div class="cardText">
            <div class="cardTextTitre">
                <p><?= ($role["nomPersonnage"]) ?></p>
            </div>
            <p>Par : <em><?= $role["nomComplet"] ?></em></p>
        </div>
    </div>
</div>


    <?php
    // Prépare les variables pour le template 
    $titre = "Détails Role";
    $titre_secondaire = "";

    // Termine la capture du contenu et le stocke dans $contenu
    $contenu = ob_get_clean();

    // Inclut le template qui utilise $contenu
    require "view/template/template.php";
    ?>