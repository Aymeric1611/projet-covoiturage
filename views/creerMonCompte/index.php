<section class="signup-card">
    <div class="signup-heading">
        <span class="signup-eyebrow">Bienvenue parmi nous</span>
        <h1>Créer mon compte</h1>
    <?php if ($compte): ?>
        <p>Compte créé avec succès.</p>
        <p><a href="index.php?action=seConnecter">Se connecter</a></p>
    </div>


    <?php else :?>
        <p>Renseignez vos informations pour rejoindre la communauté des enseignants.</p>
    </div>
    <?php if ($erreurs !== []): ?>
    <div class="alert alert-error" role="alert">
        <strong>Veuillez corriger les erreurs suivantes :</strong>
        <ul>
            <?php foreach ($erreurs as $erreur): ?>
            <li><?php echo htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form class="signup-form" method="POST" action="index.php?action=creerCompte" autocomplete="on">
        <div class="form-field">
            <label for="nom">Nom <span>*</span></label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ex. : Dupont" autocomplete="family-name" required>
        </div>

        <div class="form-field">
            <label for="prenom">Prénom <span>*</span></label>
            <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($prenom, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ex. : Jane" autocomplete="given-name" required>
        </div>

        <div class="form-field">
            <label for="email">Adresse e-mail académique <span>*</span></label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ex. : jane.doe@ac-besancon.fr" autocomplete="email" required>
            <small>Chaque adresse e-mail ne peut être utilisée qu’une seule fois.</small>
        </div>

        <div class="form-field">
            <label for="numTel">Numéro de téléphone <span>*</span></label>
            <input type="tel" name="numTel" id="numTel" value="<?php echo htmlspecialchars($numTel, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ex. : 06 12 34 56 78" autocomplete="tel" required>
        </div>

        <div class="form-field">
            <label for="mdp">Mot de passe <span>*</span></label>
            <input type="password" name="mdp" id="mdp" placeholder="Choisissez un mot de passe"
                autocomplete="new-password" required>
        </div>

        <div class="form-field">
            <label for="codeInscription">Code d’inscription <span>*</span></label>
            <input type="password" name="codeInscription" id="codeInscription"
                placeholder="Code fourni par l’établissement" autocomplete="off" required>
        </div>

        <p class="required-note"><span>*</span> Champs obligatoires</p>

        <button class="signup-submit" type="submit">Créer mon compte <span aria-hidden="true">→</span></button>
    </form>
    <?php endif; ?>
</section>
