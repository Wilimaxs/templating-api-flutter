<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/response.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    respond(204, true, 'OK', null);
}
requireMethod('GET');
requireBearerToken();

respond(200, true, 'Request berhasil. Endpoint ini tidak mengembalikan data.', null);
