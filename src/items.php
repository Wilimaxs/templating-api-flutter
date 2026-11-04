<?php
declare(strict_types=1);

function items(): array
{
    $forwardedProto = strtolower(trim(explode(',', (string) ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''))[0]));
    $scheme = $forwardedProto === 'https'
        || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https'
        : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    $localImageUrl = $scheme . '://' . $host . '/images/developer.webp';

    $items = [
        [
            'id' => 1,
            'title' => 'Pantai Senja',
            'subtitle' => 'Pemandangan sore yang tenang',
            'description' => 'Pantai dengan pasir lembut dan pemandangan matahari terbenam. Cocok untuk bersantai bersama keluarga.',
            'category' => 'Wisata',
            'rating' => 4.8,
            'image' => 'https://picsum.photos/id/1018/900/600',
        ],
        [
            'id' => 2,
            'title' => 'Hutan Pinus',
            'subtitle' => 'Udara sejuk di tengah pepohonan',
            'description' => 'Area hutan pinus yang asri dengan jalur jalan kaki. Tempat yang pas untuk menikmati udara segar.',
            'category' => 'Alam',
            'rating' => 4.6,
            // Intentionally unreachable URL to exercise Flutter image error handling.
            'image' => 'https://missing-image.invalid/item-2.jpg',
        ],
        [
            'id' => 3,
            'title' => 'Danau Biru',
            'subtitle' => 'Air jernih dikelilingi perbukitan',
            'description' => 'Danau berwarna biru dengan suasana sejuk. Pengunjung dapat menikmati pemandangan dari tepi danau.',
            'category' => 'Alam',
            'rating' => 4.7,
            'image' => 'https://picsum.photos/id/1015/900/600',
        ],
        [
            'id' => 4,
            'title' => 'Gambar Lokal',
            'subtitle' => 'Gambar dari folder project',
            'description' => 'Item contoh yang gambarnya disajikan oleh PHP dari folder public/images.',
            'category' => 'Lokal',
            'rating' => 5.0,
            'image' => $localImageUrl,
        ],
    ];

    for ($id = 5; $id <= 39; $id++) {
        $items[] = [
            'id' => $id,
            'title' => 'Item Contoh ' . $id,
            'subtitle' => 'Data contoh untuk pengujian pagination',
            'description' => 'Ini adalah data contoh nomor ' . $id . ' untuk menguji daftar dan detail pada aplikasi Flutter.',
            'category' => $id % 2 === 0 ? 'Wisata' : 'Alam',
            'rating' => 4.0 + (($id % 10) / 10),
            'image' => 'https://picsum.photos/seed/flutter-item-' . $id . '/900/600',
        ];
    }

    return $items;
}
