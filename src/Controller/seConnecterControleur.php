<?php
require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/enseignantRepository.php';

function afficherSeConnecter(PDO $connexion)
{
    $erreurs         = [];
    $email           = "";
    $mdp             = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email           = trim($_POST['email']);
        $mdp             = trim($_POST['mdp']);

        if ($email === "") {
            $erreurs[] = "L'email est obligatoire";
        }

        if ($mdp === "") {
            $erreurs[] = "Le mot de passe est obligatoire";
        }

        if ($erreurs === []) {
            $user = recupereUser($connexion, $email);
            if ($user === null){
                $erreurs[] = "L'adresse email ou le mot de passe est invalide";
            }  elseif (password_verify($mdp, $user["mdp"])){

            }
        }
    }

    afficherVue('seConnecter/index', [
        'titre' => 'Se connecter',
        'pageCourante' => 'seConnecter',
        'erreurs'         => $erreurs,
        'email'           => $email,
        'mdp'             => $mdp,
    ]);
}
