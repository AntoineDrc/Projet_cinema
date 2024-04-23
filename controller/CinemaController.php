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

        // Préparation des données pour la vue
        $acteurs = $requete->fetchAll();

        require "view/listActeurs.php";

    }

    // Méthode pour afficher les détails d'un acteur
    public function detailsActeur($id_acteur)
{
    $pdo = Connect::seConnecter();
    $requete = $pdo->prepare
    ("
        SELECT img, prenom, nom, dateNaissance, biographie
        FROM personne 
        JOIN acteur ON personne.id_personne = acteur.id_personne
        WHERE acteur.id_acteur = :id_acteur
    ");
    $requete->execute([':id_acteur' => $id_acteur]);
    $detailsActeur = $requete->fetch();

    require "view/detailsActeur.php";  // Passer les détails à la vue
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

        // Récupérer les détails du film
        $detailsFilm = $requete->fetch();

        // Inclut la vue qui affiche les films
        require "view/detailsFilm.php";
    }

    // Méthode pour afficher la liste des réalisateurs 
    public function listRealisateurs()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT img, prenom, nom, realisateur.id_realisateur
            FROM personne 
            JOIN realisateur ON personne.id_personne = realisateur.id_personne
            ORDER BY nom ASC 
        ");

        $realisateurs = $requete->fetchAll();

        require "view/listRealisateurs.php";
    }

    // Méthode pour afficher les détails d'un réalisateur
    public function detailsRealisateur($id_realisateur)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
        ("
            SELECT img, prenom, nom, dateNaissance, biographie 
            FROM personne 
            JOIN realisateur ON personne.id_personne = realisateur.id_personne
            WHERE realisateur.id_realisateur = :id_realisateur
        ");
        $requete->execute([':id_realisateur' => $id_realisateur]);
        $detailsRealisateur = $requete->fetch();

        require "view/detailsRealisateur.php";
    }

    // Méthode pour ajouter un genre : 
    public function addGenreForm()
    { 
        require "view/genreForm.php";
    }

    // Méthode pour récupérer les infos du formulaire et ajouter un genre à la base de données
    public function addGenre()
    {   
        // Utilise filter_input pour récupérer et nettoyer le genre envoyé via POST
        $genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_SPECIAL_CHARS);

        // Vérifie si la variable genre n'est pas nulle ou vide
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

    // Méthode pour afficher le formulaire d'ajout de film
    public function addFilmForm()
    {
        // Requête pour récupérer la liste des realisateurs
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT img, prenom, nom, realisateur.id_realisateur
            FROM personne 
            JOIN realisateur ON personne.id_personne = realisateur.id_personne
            ORDER BY nom ASC 
        ");
        $realisateurs = $requete->fetchAll();
        
        // Requête pour récupérer la liste des genres
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT genre, id_categorie
            FROM categorie
        ");
        $genres = $requete->fetchAll();

        require "view/filmForm.php";
    }

    // Méthode pour récuperer les infos du formulaire et ajouter un film à la base de données
    public function addFilm()
    {
        // Utilise filter_input pour récupérer et nettoyer les données envoyé via POST
        $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
        $anneeSortie = filter_input(INPUT_POST, "anneeSortie", FILTER_SANITIZE_NUMBER_INT);
        $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);

        $genre = filter_input(INPUT_POST, "genre", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $realisateur = filter_input(INPUT_POST, "realisateur", FILTER_SANITIZE_NUMBER_INT);
        
        $pdo = Connect::seConnecter();

        // Vérifie si la variable titre, anneeSortie, duree ne sont pas nulles ou vides
        if ($titre != null && $anneeSortie != null && $duree != null)
        {
            $requete = $pdo->prepare
            ('
                INSERT INTO film (titre, anneeSortie, duree, id_realisateur)
                VALUES (:titre, :anneeSortie, :duree, :id_realisateur) 
            ');
            $requete->execute([":titre"=>$titre, ":anneeSortie"=>$anneeSortie, ":duree"=>$duree, ":id_realisateur"=>$realisateur]);        
        
        }

        // Vérifie si la variable genre n'est pas nulle ou vide
        if ($genre != null)
        {
            $requete = $pdo->prepare
            ('
                INSERT INTO appartenir (id_categorie, id_film)
                VALUES (:id_categorie, :id_film)
            ');
            $requete->execute([":id_categorie"=>$genre, ":id_film"=>$pdo->lastInsertId()]);
        }

        // Vérifie si la variable realisateur n'est pas nulle ou vide
        if ($realisateur != null)
        {
            $requete = $pdo->prepare
            ('
                INSERT INTO realisateur (id_personne)
                VALUES (:id_realisateur)
            ');
            $requete->execute([":id_realisateur"=>$realisateur]);
        }
        require "view/filmForm.php";
    }   
}