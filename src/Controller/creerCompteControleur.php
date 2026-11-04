<?php

require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/creerCompteRepository.php';

function afficherCreerCompte(PDO $connexion)
{
    $erreurs         = [];
    $nom             = "";
    $prenom          = "";
    $email           = "";
    $numTel          = "";
    $mdp             = "";
    $codeInscription = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom             = trim($_POST['nom']);
        $prenom          = trim($_POST['prenom']);
        $email           = trim($_POST['email']);
        $numTel          = trim($_POST['numTel']);
        $mdp             = trim($_POST['mdp']);
        $codeInscription = trim($_POST['codeInscription']);

        if ($nom === "") {
            $erreurs[] = "Le nom est obligatoire";
        }

        if ($prenom === "") {
            $erreurs[] = "Le prénom est obligatoire";
        }

        if ($email === "") {
            $erreurs[] = "L'email est obligatoire";
        }

        if ($numTel === "") {
            $erreurs[] = "Le numero de téléphone est obligatoire";
        }

        if ($mdp === "") {
            $erreurs[] = "Le mot de passe est obligatoire";
        }

        if ($codeInscription === "" or $codeInscription !== "1964") {
            $erreurs[] = "Le code d'inscription est obligatoire";
        }

        if ($erreurs === []) {
            insertNewCompte($connexion, $nom, $prenom, $email, $numTel, $mdp);
            header("Location: index.php?action=bienvenue");
            exit();
        }
    }

        afficherVue('creerMonCompte/index', [
            'titre'           => 'Creer mon compte',
            'pageCourante'    => 'creerCompte',
            'erreurs'         => $erreurs,
            'nom'             => $nom,
            'prenom'          => $prenom,
            'email'           => $email,
            'numTel'          => $numTel,
            'mdp'             => $mdp,
            'codeInscription' => $codeInscription,
        ]);
    }