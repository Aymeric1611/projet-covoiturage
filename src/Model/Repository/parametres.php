<?php
function recupereCode(PDO $connexion): string
{
    $sql = "SELECT code FROM parametres";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    return $requete;
}
