<?php

use Controller\FilmController;

spl_autoload_register(function ($class_name) 
{
    include $class_name . '.php';
});

$ctrlFilm = new FilmController();

if (isset($_GET["action"])) 
{
    $id = $_GET['id'] ?? null;

    if ($id != null) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
    };

    switch ($_GET["action"]) {
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
    }
}
