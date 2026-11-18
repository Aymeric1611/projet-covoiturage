<?php
require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Model/Repository/enseignantRepository.php';

function afficherSeConnecter(PDO $connexion): void
{
    $erreurs = [];
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emailSaisi = $_POST['email'] ?? '';
        $email = is_string($emailSaisi) ? trim($emailSaisi) : '';
        $mdpSaisi = $_POST['mdp'] ?? '';
        $mdp = is_string($mdpSaisi) ? $mdpSaisi : '';

        if ($email === '') {
            $erreurs[] = 'L’adresse électronique est obligatoire';
        }

        if ($mdp === '') {
            $erreurs[] = 'Le mot de passe est obligatoire';
        }

        if ($erreurs === []) {
            $user = recupereUser($connexion, $email);
            if ($user === null || !password_verify($mdp, $user['mdp'])) {
                $erreurs[] = 'Adresse électronique ou mot de passe incorrect';
            } else {
                if (!session_regenerate_id(true)) {
                    throw new RuntimeException('Impossible de renouveler l’identifiant de session.');
                }

                $_SESSION = ['enseignant_id' => (int) $user['id_enseignant']];
                header('Location: index.php?action=espacePrive', true, 303);
                exit;
            }
        }
    }

    afficherVue('seConnecter/index', [
        'titre' => 'Se connecter',
        'pageCourante' => 'seConnecter',
        'erreurs' => $erreurs,
        'email' => $email,
    ]);
}
