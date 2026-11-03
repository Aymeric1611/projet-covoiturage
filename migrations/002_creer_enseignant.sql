CREATE TABLE enseignants (
    id_enseignant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    telephone VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL
);

INSERT INTO parametres (code)
SELECT '1964'
WHERE NOT EXISTS (
    SELECT 1
    FROM parametres
    WHERE code IS NOT NULL
      AND TRIM(code) <> ''
);