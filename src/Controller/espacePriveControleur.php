<?php

require_once __DIR__ . '/../View/view.php';

function afficherEspacePrive(array $enseignant): void
{
    afficherVue('espacePrive/index', [
        'titre' => 'Mon espace',
        'pageCourante' => 'espacePrive',
        'enseignant' => $enseignant,
    ]);
}
