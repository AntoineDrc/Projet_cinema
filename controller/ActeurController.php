<?php

namespace controller;

use Model\Connect;

class ActeurController
{
    // Méthode pour récupérer et afficher la liste des acteurs
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT personne.img, personne.id_personne, personne.prenom, personne.nom, acteur.id_acteur
            FROM personne
            JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        // Préparation des données pour la vue
        $acteurs = $requete->fetchAll();

        require "view/acteur/listActeurs.php";
    }

    // Méthode pour afficher les détails d'un acteur
    public function detailsActeur($id_acteur)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
        ("
            SELECT img, prenom, nom, biographie, 
            DATE_FORMAT (personne.dateNaissance, '%d/%m/%Y') AS dateNaissance
            FROM personne 
            JOIN acteur ON personne.id_personne = acteur.id_personne
            WHERE acteur.id_acteur = :id_acteur
        ");

        $requete->execute
        ([
            ':id_acteur' => $id_acteur
        ]);

        $acteur = $requete->fetch();

        // Reqûete pour afficher la filmographie de l'acteur
        $requeteNbFilms = $pdo->prepare
        ("
            SELECT film.img, film.titre, film.anneeSortie, CONCAT(FLOOR(film.duree / 60), 'h', LPAD(film.duree % 60, 2, '0'), 'm') AS duree, role.nomPersonnage
            FROM film
            JOIN jouer ON film.id_film = jouer.id_film
            JOIN acteur ON jouer.id_acteur = acteur.id_acteur
            JOIN role ON jouer.id_role = role.id_role
            WHERE acteur.id_acteur = :id_acteur
        ");

        $requeteNbFilms->execute
        ([
            ':id_acteur' => $id_acteur
        ]);
        
        $nbFilms = $requeteNbFilms->fetchAll();

        require "view/acteur/detailsActeur.php";  
    }
}