<section class="signup-card">
    
    <h1>Se connecter</h1>
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

    <form class="signup-form" method="post" action="index.php?action=seConnecter">
        <div class="form-field">
            <label for="email">Adresse e-mail</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ex. : jane.doe@exemple.fr" autocomplete="email" required>
        </div>
        <div class="form-field">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="Entrez votre mot de passe"
                autocomplete="new-password" required>
        </div>
        <button class="signup-submit" type="submit">Se connecter <span aria-hidden="true">→</span></button>
    </form>
</section>
