<?php
function insertNewCompte(PDO $connexion, string $nom, string $prenom, string $email, string $numTel, string $mdp): void
{
    $sql     = "INSERT INTO enseignants(nom, prenom, email, telephone, mdp) VALUES (:nom, :prenom, :email, :telephone, :mdp)";
    $requete = $connexion->prepare($sql);
    $requete->execute([
        "nom"       => $nom,
        "prenom" => $prenom,
        "email"       => $email,
        "telephone" => $numTel,
        "mdp"       => $mdp,
    ]);
}