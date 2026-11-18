<?php

require_once __DIR__ . '/../View/view.php';
require_once __DIR__ . '/../Controller/bienvenueControleur.php';
require_once __DIR__  . '/../Controller/creerCompteControleur.php';
require_once __DIR__ . '/../Controller/seConnecterControleur.php';
require_once __DIR__ . '/../Controller/espacePriveControleur.php';
require_once __DIR__ . '/../Model/Repository/enseignantRepository.php';

function afficherErreur404(string $action = ''): void
{
    http_response_code(404);
    afficherVue('errors/404', [
        'titre' => '404 — Page introuvable',
        'pageCourante' => '',
        'action' => $action,
    ]);
}

function afficherErreur405(array $methodesAutorisees = [], string $methode = ''): void
{
    http_response_code(405);

    if ($methodesAutorisees !== []) {
        header('Allow: ' . implode(', ', $methodesAutorisees));
    }

    afficherVue('errors/405', [
        'titre' => '405 — Méthode non autorisée',
        'pageCourante' => '',
        'methodesAutorisees' => $methodesAutorisees,
        'methode' => $methode,
    ]);
}

function routerRequete(PDO $connexion): void
{
    // Le fichier retourne un tableau : le relire à chaque appel du routeur.
    $routes = require __DIR__ . '/../../config/routes.php';
    $action = $_GET['action'] ?? 'bienvenue';
    $methode = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    // Une action peut aussi être envoyée sous forme de tableau dans l'URL.
    if (!is_string($action) || !array_key_exists($action, $routes)) {
        afficherErreur404(is_string($action) ? $action : '');
        return;
    }

    if (!in_array($methode, $routes[$action], true)) {
        afficherErreur405($routes[$action], $methode);
        return;
    }

    $enseignantConnecte = null;
    if (isset($_SESSION['enseignant_id'])) {
        $idEnseignant = $_SESSION['enseignant_id'];
        if (is_int($idEnseignant) && $idEnseignant > 0) {
            $enseignantConnecte = recupereEnseignantParId($connexion, $idEnseignant);
        }

        if ($enseignantConnecte === null) {
            $_SESSION = [];
            if (!session_regenerate_id(true)) {
                throw new RuntimeException('Impossible de renouveler l’identifiant de session.');
            }
        }
    }

    if ($action === 'espacePrive') {
        header('Cache-Control: no-store, private');
        header('Pragma: no-cache');
        header('Expires: 0');

        if ($enseignantConnecte === null) {
            header('Location: index.php?action=seConnecter', true, 303);
            return;
        }
    }

    match ($action) {
        'bienvenue' => afficherBienvenue($connexion),
        'creerCompte' => afficherCreerCompte($connexion),
        'seConnecter' => afficherSeConnecter($connexion),
        'espacePrive' => afficherEspacePrive($enseignantConnecte),
    };
}