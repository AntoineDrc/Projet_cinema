<?php ob_start(); ?>

<div class="titrePage">
    <h1>LES ROLES</h1>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ROLE</th>
            <th>ACTEUR PRENOM</th>
            <th>ACTEUR NOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Boucle sur chaque film récupéré de la base de données.
        foreach ($roles as $role)
        {
            $detailsUrl = "index.php?action=detailsRole&id=" . $role['id_role'];
        ?>
            <tr>
                <td><a href="<?= $detailsUrl ?>">
                    <?= $role["nomPersonnage"] ?></a></td>
                <td><?= $role["prenom"] ?></td>
                <td><?= $role["nom"] ?></td>
            </tr>
        <?php
        }
        ?>
</table>




<?php
// Prépare les variables pour le template 
$titre = "Liste des rôles";
$titre_secondaire = "";

// Termine la capture du contenu et le stocke dans $contenu
$contenu = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template/template.php";
?>