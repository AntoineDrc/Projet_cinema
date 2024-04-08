<?php

// Utilise l'espace de noms du contrôleur pour accèder à CinemaController
use Controller\CinemaController;

// Enregistre une fonction d'autoload pour charger automatiquement les classes nécessaires
spl_autoload_register(function ($class_name)
{
    include $class_name . '.php';
});

// Instancie le contrôleur de cinéma
$ctrlCinema = new CinemaController();

// Vérifie si une action est spécifiée dans l'URL 
if(isset($_GET["action"]))
{
    // Execute une action en fonction du paramètre "action"
    switch ($_GET["action"])
    {
        case "listFilms": // Affiche la liste des films
            $ctrlCinema->listFilms();
            break;
        case "listActeurs": // Affiche la liste des acteurs
            $ctrlCinema->listActeurs();
            break;
    }
}