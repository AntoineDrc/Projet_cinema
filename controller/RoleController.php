<?php

namespace controller;

use Model\Connect;

class RoleController
{
    // Méthode pour afficher la liste des rôles
    public function listRoles()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query
        ("
            SELECT role.img, role.id_role, nomPersonnage, personne.prenom, personne.nom
            FROM role
            JOIN jouer ON role.id_role = jouer.id_role
            JOIN acteur ON jouer.id_acteur = acteur.id_acteur
            JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY id_film ASC
        ");

        $roles = $requete->fetchAll();

        require "view/role/listRoles.php";
    }

    // Méthode pour afficher les détails d'un rôle
    public function detailsRole($id_role)
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare
        ("
            SELECT role.id_role, personne.img, film.titre, role.nomPersonnage, 
            CONCAT(personne.prenom, ' ', personne.nom) AS nomComplet 
            FROM role
            JOIN jouer ON role.id_role = jouer.id_role
            JOIN acteur ON jouer.id_acteur = acteur.id_acteur
            JOIN personne ON acteur.id_personne = personne.id_personne
            JOIN film ON jouer.id_film = film.id_film
            WHERE role.id_role = :id_role
        ");
        
        $requete->execute
        ([
            ':id_role' => $id_role
        ]);

        $role = $requete->fetch();

        require "view/role/detailsRole.php";
    }
}