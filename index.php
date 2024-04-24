<?php

// Utilise l'espace de noms du contrôleur pour accèder aux différentes classes de contrôleurs
use Controller\FilmController;
use Controller\GenreController;
use Controller\ActeurController;
use Controller\RealisateurController;
use Controller\RoleController;

// Enregistre une fonction d'autoload pour charger automatiquement les classes nécessaires
spl_autoload_register(function ($class_name) 
{
    include $class_name . '.php';
});

// Instancie les différents contrôleurs
$ctrlFilm = new FilmController();
$ctrlGenre = new GenreController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();
$ctrlRole = new RoleController();

// Vérifie si une action est spécifiée dans l'URL 
if (isset($_GET["action"])) {
    // Récupère l'ID de l'acteur si présent
    $id = $_GET['id'] ?? null;

    if ($id != null) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
    };

    // Execute une action en fonction du paramètre "action"
    switch ($_GET["action"]) 
    {
        case "listFilms": // Affiche la liste des films
            $ctrlFilm->listFilms();
            break;
        case 'detailsFilm':
            $ctrlFilm->detailsFilm($id);
            break;
        case "addFilmForm":
            $ctrlFilm->addFilmForm();
            break;
        case "addFilm":
            $ctrlFilm->addFilm();
            break;
        case "listActeurs": 
            $ctrlActeur->listActeurs();
            break;
        case 'detailsActeur':
            $ctrlActeur->detailsActeur($id);
            break;
        case "listRoles":
            $ctrlRole->listRoles();
            break;
        case "detailsRole":
            $ctrlRole->detailsRole($id);
            break;
        case "listRealisateurs":
            $ctrlRealisateur->listRealisateurs();
            break;
        case "detailsRealisateur":
            $ctrlRealisateur->detailsRealisateur($id);
            break;
        case "addRealisateurForm":
            $ctrlRealisateur->addRealisateurForm();
            break;
        case "addRealisateur":
            $ctrlRealisateur->addRealisateur();
            break;
        case "listGenres":
            $ctrlGenre->listGenres();
            break;
        case "detailsGenre":
            $ctrlGenre->detailsGenre($id);
        case "addGenreForm":
            $ctrlGenre->addGenreForm();
            break;
        case "addGenre":
            $ctrlGenre->addGenre();
            break;
        case "editGenreForm":
            $ctrlGenre->editGenreForm($id);
            break;
        case "editGenre":
            $ctrlGenre->editGenre($id);
            break;
    }
} else 
{
    // Si aucune action n'est définie dans l'URL, charger la page d'accueil
    $ctrlGenre->home();
}
