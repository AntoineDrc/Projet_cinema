<?php

// Déclaration de l'espace de noms 'Model'. Cela permet d'organiser le code et d'éviter les conflits de noms.
namespace Model;

// Déclare une classe abstraite 'Connect'. Une classe abstraite ne peut pas être instanciée directement.
// Elle sert ici principalement à regrouper des fonctionnalités liées à la connexion à la base de données.
abstract class Connect
{
    // Constantes de la classe pour les informations de connexion à la base de données.
    // L'utilisation de constantes permet de centraliser ces informations et de les rendre facilement modifiables.
    const HOST = "localhost"; // L'adresse de l'hôte de la base de données.
    const DB = "cinema"; // Le nom de la base de données.
    const USER = "root"; // Le nom d'utilisateur pour se connecter à la base de données.
    const PASS = ""; // Le mot de passe associé à l'utilisateur de la base de données.

    // Méthode statique publique 'seConnecter' qui établit et retourne une connexion à la base de données.
    public static function seConnecter()
    {
        // Bloc try-catch pour gérer les exceptions qui pourraient survenir lors de la tentative de connexion à la base de données.
        try
        {
            // Tente de créer une nouvelle instance de PDO en utilisant les constantes de connexion définies plus haut.
            // La chaîne de connexion (DSN) inclut le type de base de données (mysql), l'hôte, le nom de la base de données, et l'encodage (utf8).
            return new \PDO
            (
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS
            );
        }
        catch (\PDOException $ex) {
            // Affiche le message d'erreur et arrête l'exécution du script.
            die('Erreur de connexion : ' . $ex->getMessage());
        }
        
    }
}