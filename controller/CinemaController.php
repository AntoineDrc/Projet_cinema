<?php

// Définit le namespace pour organiser le code 
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
        SELECT titre, anneeSortie, film.id_film,
        CONCAT(FLOOR(film.duree / 60), 'h', LPAD (film.duree % 60, 2, '0')) AS duree, categorie.genre, film.note
        FROM film
        JOIN appartenir ON film.id_film = appartenir.id_film
        JOIN categorie ON appartenir.id_categorie = categorie.id_categorie
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
            SELECT personne.id_personne, personne.prenom, personne.nom, acteur.id_acteur
            FROM personne
            JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        require "view/listActeurs.php";

    }

    // Méthode pour afficher les détails d'un acteur
    public function detailsActeur($id_acteur)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
    ("
        SELECT prenom, nom, sexe, dateNaissance, biographie
        FROM personne 
        JOIN acteur ON personne.id_personne = acteur.id_personne
        WHERE acteur.id_acteur = :id 
    ");
        $requete->execute([":id"=>$id_acteur]);

    $listActeurs = $pdo->query
    ("
        SELECT personne.id_personne, personne.prenom, personne.nom, acteur.id_acteur
        FROM personne
        JOIN acteur ON personne.id_personne = acteur.id_personne
    ");
    require "view/detailsActeur.php";
    }

    // Méthode pour afficher les détails d'un film
    public function detailsFilm($id_film)
    {   
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
    ("
    SELECT 
    film.img,
    film.id_film,
    film.titre, 
    film.anneeSortie, 
    CONCAT(FLOOR(film.duree / 60), 'h', LPAD(film.duree % 60, 2, '0'), 'm') AS duree,
    categorie.genre, 
    persRealisateur.prenom AS prenomRealisateur, 
    persRealisateur.nom AS nomRealisateur,
    GROUP_CONCAT(DISTINCT CONCAT(persActeur.prenom, ' ', persActeur.nom) SEPARATOR ', ') AS acteurs, 
    film.note
    FROM 
    film
    JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
    JOIN personne AS persRealisateur ON realisateur.id_personne = persRealisateur.id_personne
    JOIN jouer ON film.id_film = jouer.id_film
    JOIN acteur ON jouer.id_acteur = acteur.id_acteur
    JOIN personne AS persActeur ON acteur.id_personne = persActeur.id_personne
    JOIN appartenir ON film.id_film = appartenir.id_film 
    JOIN categorie ON appartenir.id_categorie = categorie.id_categorie
    WHERE film.id_film = :id
    GROUP BY 
    film.id_film, film.titre, film.anneeSortie, film.duree, categorie.genre, 
    persRealisateur.prenom, persRealisateur.nom, film.note;

    ");
    $requete->execute([":id"=>$id_film]);

    $listFilms = $pdo->query
        ("
        SELECT titre, anneeSortie, film.id_film,
        CONCAT(FLOOR(film.duree / 60), 'h', LPAD (film.duree % 60, 2, '0')) AS duree, categorie.genre, film.note
        FROM film
        JOIN appartenir ON film.id_film = appartenir.id_film
        JOIN categorie ON appartenir.id_categorie = categorie.id_categorie
        ");

        // Inclut la vue qui affiche les films
        require "view/detailsFilm.php";
    }

    // Méthode pour ajouter un genre : 
    public function addGenreForm()
    { 
        require "view/genreForm.php";
    }

    public function addGenre()
    {
        $genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($genre != null)
        {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare
            ('
                INSERT INTO categorie (genre)
                VALUES (:nom_genre)
            ');
            $requete->execute([":nom_genre"=>$genre]);
        }
        require "view/genreForm.php";
    }
}
