<?php

// Définit le namesapce pour organise le code 
namespace Controller;

// Importe la classe Connect pour la connexion à la base de données 
use Model\Connect;

class CinemaController
{   
    // Méthode pour afficher la page d'accueil
    public function home()
    {
        // Inclut la vue home
        require "view/home.php";
    }


    // Méthode pour récupérer et afficher la liste des films
    public function listFilms()
    {
        // Etablit la connexion à la base de données
        $pdo = Connect::seConnecter();

        // Exécute la requête SQL pour sélectionner les films
        $requete = $pdo->query
        ("
        SELECT titre, anneeSortie,
        CONCAT(FLOOR(film.duree / 60), 'h', LPAD (film.duree % 60, 2, '0')) AS duree, categorie.genre, film.note
        FROM film
        JOIN appartenir ON film.id_film = appartenir.id_film
        JOIN categorie ON appartenir.id_film = categorie.id_categorie
        ");

        // Inclut la vue qui affiche les films
        require "view/listFilms.php";
    }
    

    // Méthode pour récupérer et afficher la liste des acteurs
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT prenom, nom
            FROM personne
            JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        require "view/listActeurs.php";

    }
}