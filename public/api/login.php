<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/response.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    respond(204, true, 'OK', null);
}
requireMethod('POST');

$input = requestData();
$email = trim((string) ($input['email'] ?? ''));
$password = (string) ($input['password'] ?? '');

if ($email === '' || $password === '') {
    respond(422, false, 'Email dan password wajib diisi.', null);
}

// Demo account for API and SharedPreferences testing; this is not production auth.
if ($email !== 'demo@example.com' || $password !== 'password123') {
    respond(401, false, 'Email atau password salah.', null);
}

respond(200, true, 'Login berhasil.', [
    'token' => API_TEST_TOKEN,
    'user' => [
        'id' => 1,
        'name' => 'Demo User',
        'email' => $email,
        'avatar' => 'https://i.pravatar.cc/300?img=12',
    ],
]);
