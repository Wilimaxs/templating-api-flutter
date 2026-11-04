<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/response.php';
require_once __DIR__ . '/../../src/items.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    respond(204, true, 'OK', null);
}
requireMethod('GET');
requireBearerToken();

$allItems = array_map(static function (array $item): array {
    return [
        'id' => $item['id'],
        'title' => $item['title'],
        'subtitle' => $item['subtitle'],
        'category' => $item['category'],
        'rating' => $item['rating'],
        'image' => $item['image'],
    ];
}, items());

$pageInput = $_GET['page'] ?? '1';
$page = filter_var($pageInput, FILTER_VALIDATE_INT);
$perPage = 20;

if ($page === false || $page < 1) {
    respond(422, false, 'Parameter page harus berupa bilangan bulat minimal 1.', null);
}

$total = count($allItems);
$lastPage = max(1, (int) ceil($total / $perPage));
$offset = ($page - 1) * $perPage;
$pageItems = array_slice($allItems, $offset, $perPage);

respond(200, true, 'Daftar data berhasil diambil.', [
    'items' => $pageItems,
    'pagination' => [
        'total' => $total,
        'per_page' => $perPage,
        'current_page' => $page,
        'last_page' => $lastPage,
    ],
]);
