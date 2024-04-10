<?php ob_start(); ?>

<header>
    <nav>
        <div class="navTop">
            <div class="titreSite">
                <i class="fa-solid fa-film fa-lg" style="color: #002367;"></i>
                <h1>ADMovies</h1>
            </div>
            <div class="barreRecherche">
                <input type="text" placeholder="Rechercher un film, un acteur ...">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass fa-2xs" style="color: #adadad;"></i>
                </button>
            </div>
        </div>
        <div class="navBot">
            <a href="listFilms.php">FILMS</a>
            <a href="listActeurs.php">ACTEURS</a>
            <a href="listRealisateurs.php">REALISATEURS</a>
        </div>
    </nav>
</header>

<?php

// Termine la capture du contenu et le stocke dans $contenu
$contenuNav = ob_get_clean();

// Inclut le template qui utilise $contenu
require "view/template.php";
?>