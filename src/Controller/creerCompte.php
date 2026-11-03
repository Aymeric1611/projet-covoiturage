<?php

require_once __DIR__ . '/../View/view.php';

function afficherCreerCompte(PDO $connexion)
{
    afficherVue('creerMonCompte/index', [
        'titre'        => 'Creer mon compte',
        'pageCourante' => 'creerCompte',
    ]);
}
