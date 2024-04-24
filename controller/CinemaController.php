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


    // Méthode pour récupérer et afficher la liste des acteurs
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT personne.id_personne, personne.prenom, personne.nom, acteur.id_acteur
            FROM personne
            JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        // Préparation des données pour la vue
        $acteurs = $requete->fetchAll();

        require "view/listActeurs.php";
    }

    // Méthode pour afficher la liste des genres
    public function listGenres()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT img, genre, id_categorie
            FROM categorie
        ");

        $genres = $requete->fetchAll();

        require "view/listGenres.php";
    }

    // Méthode pour afficher les détails d'un genre
    public function detailsGenre($id_genre)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT img, genre, id_categorie
            FROM categorie
            WHERE id_categorie = :id_genre
        ");
        $requete->execute([':id_genre' => $id_genre]);
        $detailsGenre = $requete->fetch();

        $requeteFilmGenre = $pdo->prepare("
            SELECT film.img, film.titre, film.anneeSortie,
            CONCAT(FLOOR(film.duree / 60), 'h', LPAD (film.duree % 60, 2, '0')) AS duree
            FROM categorie
            JOIN appartenir ON categorie.id_categorie = appartenir.id_categorie
            JOIN film ON appartenir.id_film = film.id_film
            WHERE categorie.id_categorie = :id_genre
            ORDER BY titre ASC 
        ");
        $requeteFilmGenre->execute([':id_genre' => $id_genre]);
        $films = $requeteFilmGenre->fetchAll();

        require "view/detailsGenre.php";
    }

    // Méthode pour afficher la liste des rôles
    public function listRoles()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT role.id_role, nomPersonnage, personne.prenom, personne.nom
            FROM role
            JOIN jouer ON role.id_role = jouer.id_role
            JOIN acteur ON jouer.id_acteur = acteur.id_acteur
            JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY id_film ASC
            
        ");

        $roles = $requete->fetchAll();

        require "view/listRoles.php";
    }

    // Méthode pour afficher les détails d'un rôle
    public function detailsRole($id_role)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT role.id_role, personne.img, film.titre, role.nomPersonnage, 
        CONCAT(personne.prenom, ' ', personne.nom) AS nomComplet 
        FROM role
        JOIN jouer ON role.id_role = jouer.id_role
        JOIN acteur ON jouer.id_acteur = acteur.id_acteur
        JOIN personne ON acteur.id_personne = personne.id_personne
        JOIN film ON jouer.id_film = film.id_film
        WHERE role.id_role = :id_role
        
        ");
        $requete->execute([':id_role' => $id_role]);
        $detailsRole = $requete->fetch();

        require "view/detailsRole.php";
    }

    // Méthode pour afficher les détails d'un acteur
    public function detailsActeur($id_acteur)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT img, prenom, nom, dateNaissance, biographie
        FROM personne 
        JOIN acteur ON personne.id_personne = acteur.id_personne
        WHERE acteur.id_acteur = :id_acteur
    ");
        $requete->execute([':id_acteur' => $id_acteur]);
        $detailsActeur = $requete->fetch();

        // Reqûete pour afficher la filmographie de l'acteur
        $requeteNbFilms = $pdo->prepare("
    SELECT film.img, film.titre, film.anneeSortie, CONCAT(FLOOR(film.duree / 60), 'h', LPAD(film.duree % 60, 2, '0'), 'm') AS duree, role.nomPersonnage
    FROM film
    JOIN jouer ON film.id_film = jouer.id_film
    JOIN acteur ON jouer.id_acteur = acteur.id_acteur
    JOIN role ON jouer.id_role = role.id_role
    WHERE acteur.id_acteur = :id_acteur
    ");
        $requeteNbFilms->execute([':id_acteur' => $id_acteur]);
        $nbFilms = $requeteNbFilms->fetchAll();


        require "view/detailsActeur.php";  // Passer les détails à la vue
    }

    // Méthode pour afficher la liste des réalisateurs 
    public function listRealisateurs()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
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
        $requete = $pdo->prepare("
            SELECT img, prenom, nom, dateNaissance, biographie 
            FROM personne 
            JOIN realisateur ON personne.id_personne = realisateur.id_personne
            WHERE realisateur.id_realisateur = :id_realisateur
        ");
        $requete->execute([':id_realisateur' => $id_realisateur]);
        $detailsRealisateur = $requete->fetch();

        // Requête pour afficher le nombre de films réalisés par le réalisateur
        $requeteNbFilms = $pdo->prepare("
        SELECT film.img, film.titre, film.anneeSortie, personne.prenom AS prenomRealisateur, personne.nom AS nomRealisateur
        FROM film
        JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        JOIN personne ON realisateur.id_personne = personne.id_personne
        WHERE realisateur.id_personne = :id_realisateur
        ");
        $requeteNbFilms->execute([':id_realisateur' => $id_realisateur]);
        $nbFilms = $requeteNbFilms->fetchAll();


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
        if ($genre != null) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('
                INSERT INTO categorie (genre)
                VALUES (:nom_genre)
            ');
            $requete->execute([":nom_genre" => $genre]);
        }
        require "view/genreForm.php";
    }

    // Méthode pour afficher le formulaire d'ajout de réalisateur
    public function addRealisateurForm()
    {
        require "view/realisateurForm.php";
    }

    // Méthode pour récupérer les infos du formulaire et ajouter un réalisateur à la base de données
    public function addRealisateur()
    {
        // Utilise filter_input pour récupérer et nettoyer les données envoyé via POST
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
        $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_NUMBER_INT);

        $pdo = Connect::seConnecter();

        // Vérifie si la variable prenom, nom, sexe, dateNaissance ne sont pas nulles ou vides
        if ($prenom != null && $nom != null && $sexe != null && $dateNaissance != null) {
            // Ajoute une personne à la base de données (table personne)
            $requetePersonne = $pdo->prepare('
                INSERT INTO personne (prenom, nom, sexe, dateNaissance)
                VALUES (:prenom, :nom, :sexe, :dateNaissance)
            ');
            $requetePersonne->execute([
                ":prenom" => $prenom,
                ":nom" => $nom,
                ":sexe" => $sexe,
                ":dateNaissance" => $dateNaissance
            ]);

            // Récupère l'ID de la personne ajoutée
            $idPersonne = $pdo->lastInsertId();

            // Ajoute un réalisateur à la base de données (table réalisateur)
            $requeteRealisateur = $pdo->prepare('
                INSERT INTO realisateur (id_personne)
                VALUES (:id_personne)
            ');
            $requeteRealisateur->execute([":id_personne" => $idPersonne]);
        }
        require "view/realisateurForm.php";
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

        require "view/editGenreForm.php";
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
