<?php
function insertNewCompte(PDO $connexion, string $nom, string $prenom, string $email, string $numTel, string $mdp): void
{
    $mdp     = password_hash($mdp, PASSWORD_DEFAULT);
    $sql     = "INSERT INTO enseignants(nom, prenom, email, telephone, mdp) VALUES (:nom, :prenom, :email, :telephone, :mdp)";
    $requete = $connexion->prepare($sql);
    $requete->execute([
        "nom"       => $nom,
        "prenom"    => $prenom,
        "email"     => $email,
        "telephone" => $numTel,
        "mdp"       => $mdp,
    ]);
}

function recupereUser(PDO $connexion, string $email): ?array
{
    $sql     = "SELECT * FROM enseignants WHERE email = :email";
    $requete = $connexion->prepare($sql);
    $requete->execute([
        "email" => $email,
    ]);
    return $requete->fetch(PDO::FETCH_ASSOC) ?: null;
}

function recupereEnseignantParId(PDO $connexion, int $id): ?array
{
    $sql = "SELECT id_enseignant, nom, prenom, email FROM enseignants WHERE id_enseignant = :id";
    $requete = $connexion->prepare($sql);
    $requete->execute(['id' => $id]);

    return $requete->fetch(PDO::FETCH_ASSOC) ?: null;
}
