<?php

function seDeconnecter(): void
{
    $_SESSION = [];

    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }

    $estHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => '/',
        'secure' => $estHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    header('Cache-Control: no-store, private');
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Location: index.php?action=seConnecter', true, 303);
    exit;
}
