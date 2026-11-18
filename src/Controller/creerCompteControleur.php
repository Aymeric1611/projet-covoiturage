<?php

require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/enseignantRepository.php';
require_once __DIR__ . '/../Model/Repository/parametres.php';

function afficherCreerCompte(PDO $connexion): void
{
    $domaine = "@ac-besancon.fr";
    $erreurs         = [];
    $nom             = "";
    $prenom          = "";
    $email           = "";
    $numTel          = "";
    $mdp             = "";
    $codeInscription = "";
    $compteValide = false;

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
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, $domaine)){
            $erreurs[] = "L'email doit être un email académique";
        } elseif (recupereUser($connexion, $email) !== null) {
            $erreurs[] = "L'email a déjà été utilisé";
        }

        if ($numTel === "") {
            $erreurs[] = "Le numéro de téléphone est obligatoire";
        } elseif (preg_match('/^0[1-9](?: [0-9]{2}){4}$/',$numTel) !== 1){
            $erreurs[] = "Le numéro de téléphone doit être du format 06 24 26 35 15";
        }

        if ($mdp === "") {
            $erreurs[] = "Le mot de passe est obligatoire";
        }

        if ($codeInscription === "") {
            $erreurs[] = "Le code d'inscription est obligatoire";
        } elseif ($codeInscription !== recupereCode($connexion)) {
            $erreurs[] = "Le code d'inscription n'est pas le bon";
        }

        if ($erreurs === []) {
            insertNewCompte($connexion, $nom, $prenom, $email, $numTel, $mdp);
            $compteValide = true;
            header("Location: index.php?action=validationCompte");
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
            'compte' => $compteValide
        ]);
    }