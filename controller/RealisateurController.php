<?php

namespace controller;

use Model\Connect;

class RealisateurController
{
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

        $requete->execute
        ([
            ':id_realisateur' => $id_realisateur
        ]);

        $detailsRealisateur = $requete->fetch();

        // Requête pour afficher le nombre de films réalisés par le réalisateur
        $requeteNbFilms = $pdo->prepare
        ("
            SELECT film.img, film.titre, film.anneeSortie, personne.prenom AS prenomRealisateur, personne.nom AS nomRealisateur
            FROM film
            JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE realisateur.id_personne = :id_realisateur
        ");
        
        $requeteNbFilms->execute
        ([
            ':id_realisateur' => $id_realisateur
        ]);

        $nbFilms = $requeteNbFilms->fetchAll();

        require "view/detailsRealisateur.php";
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
        if ($prenom != null && $nom != null && $sexe != null && $dateNaissance != null) 
        {
            // Ajoute une personne à la base de données (table personne)
            $requetePersonne = $pdo->prepare
            ('
                INSERT INTO personne (prenom, nom, sexe, dateNaissance)
                VALUES (:prenom, :nom, :sexe, :dateNaissance)
            ');

            $requetePersonne->execute
            ([
                ":prenom" => $prenom,
                ":nom" => $nom,
                ":sexe" => $sexe,
                ":dateNaissance" => $dateNaissance
            ]);

            // Récupère l'ID de la personne ajoutée
            $idPersonne = $pdo->lastInsertId();

            // Ajoute un réalisateur à la base de données (table réalisateur)
            $requeteRealisateur = $pdo->prepare
            ('
                INSERT INTO realisateur (id_personne)
                VALUES (:id_personne)
            ');
            $requeteRealisateur->execute
            ([
                ":id_personne" => $idPersonne
            ]);
            require "view/realisateurForm.php";
        }
    }
}