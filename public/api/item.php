<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/response.php';
require_once __DIR__ . '/../../src/items.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    respond(204, true, 'OK', null);
}
requireMethod('GET');
requireBearerToken();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
foreach (items() as $item) {
    if ($id !== false && $id !== null && $item['id'] === $id) {
        respond(200, true, 'Detail data berhasil diambil.', $item);
    }
}

respond(404, false, 'Data tidak ditemukan.', null);
