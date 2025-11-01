<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setClientId('77160664870-83tonfohpo6m085hnhe442a2u29v9udu.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://developers.google.com/oauthplayground');
$client->addScope('https://www.googleapis.com/auth/drive');
$client->setAccessType('offline'); // ini penting untuk refresh token
$client->setPrompt('consent');     // pastikan minta izin ulang

// Cek apakah ada argument "code"
if (!isset($argv[1])) {
    $authUrl = $client->createAuthUrl();
    echo "Buka URL ini di browser kamu:\n$authUrl\n";
    echo "\nSetelah login, salin kode `code=...` dari URL redirect dan jalankan lagi script ini:\n";
    echo "php get-google-refresh-token.php \"PASTE_KODE_DI_SINI\"\n";
    exit;
}

$code = $argv[1];
$client->fetchAccessTokenWithAuthCode($code);
$token = $client->getAccessToken();

echo "\n=== Refresh Token ===\n";
echo $token['refresh_token'] ?? 'Gagal dapat refresh_token. Coba ulangi dengan setPrompt(\'consent\') dan setAccessType(\'offline\').';
echo "\n";
