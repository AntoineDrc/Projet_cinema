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
        $requete = $pdo->query("SELECT titre, anneeSortie FROM film");

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