<section class="signup-card" aria-labelledby="titre-espace">
    <h1 id="titre-espace">Bienvenue <?= htmlspecialchars($enseignant['prenom'], ENT_QUOTES, 'UTF-8') ?></h1>
    <p>Vous êtes connecté avec l’adresse <?= htmlspecialchars($enseignant['email'], ENT_QUOTES, 'UTF-8') ?>.</p>
    <p>Votre espace enseignant est accessible tant que votre session reste valide.</p>
</section>
