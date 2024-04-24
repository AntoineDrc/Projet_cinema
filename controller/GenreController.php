<?php

// Définit le namespace pour organiser le code 
namespace Controller;

// Importe la classe Connect pour la connexion à la base de données 
use Model\Connect;

class GenreController
{
    // Méthode pour afficher la page d'accueil
    public function home()
    {
        // Inclut la vue home
        require "view/template/home.php";
    }

    // Méthode pour afficher la liste des genres
    public function listGenres()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT img, genre, id_categorie
            FROM categorie
        ");

        $genres = $requete->fetchAll();

        require "view/genre/listGenres.php";
    }

    // Méthode pour afficher les détails d'un genre
    public function detailsGenre($id_genre)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
        ("
            SELECT img, genre, id_categorie
            FROM categorie
            WHERE id_categorie = :id_genre
        ");
        $requete->execute
        ([
            ':id_genre' => $id_genre
        ]);

        $detailsGenre = $requete->fetch();

        // Requête pour afficher les films du genre
        $requeteFilmGenre = $pdo->prepare
        ("
            SELECT film.img, film.titre, film.anneeSortie,
            CONCAT(FLOOR(film.duree / 60), 'h', LPAD (film.duree % 60, 2, '0')) AS duree
            FROM categorie
            JOIN appartenir ON categorie.id_categorie = appartenir.id_categorie
            JOIN film ON appartenir.id_film = film.id_film
            WHERE categorie.id_categorie = :id_genre
            ORDER BY titre ASC 
        ");

        $requeteFilmGenre->execute
        ([
            ':id_genre' => $id_genre
        ]);

        $films = $requeteFilmGenre->fetchAll();

        require "view/genre/detailsGenre.php";
    }

    // Méthode pour ajouter un genre : 
    public function addGenreForm()
    {
        require "view/genre/genreForm.php";
    }

    // Méthode pour récupérer les infos du formulaire et ajouter un genre à la base de données
    public function addGenre()
    {
        // Utilise filter_input pour récupérer et nettoyer le genre envoyé via POST
        $genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_SPECIAL_CHARS);

        // Vérifie si la variable genre n'est pas nulle ou vide
        if ($genre != null) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                INSERT INTO categorie (genre)
                VALUES (:nom_genre)
            ');
            $requete->execute([":nom_genre" => $genre]);
        }
        require "view/genre/genreForm.php";
    }

    // Méthode pour afficher le formulaire d'édit de genre
    public function editGenreForm($id_genre)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT genre, id_categorie
            FROM categorie
            WHERE id_categorie = :id_genre
        ");
        $requete->execute([':id_genre' => $id_genre]);
        $genre = $requete->fetch();

        require "view/genre/editGenreForm.php";
    }

    // Méthode pour récuperer les info du formulaire et modifier le genre dans la base de données
    public function editGenre($id_genre)
    {
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            UPDATE categorie
            SET genre = :nom_genre
            WHERE id_categorie = :id_genre
        ");
        $requete->execute([':nom_genre' => $genre, ':id_genre' => $id_genre]);

        header('location:index.php?action=editGenreForm&id=' . $id_genre);
    }
}
