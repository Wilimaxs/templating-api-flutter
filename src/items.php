<?php
declare(strict_types=1);

function items(): array
{
    $forwardedProto = strtolower(trim(explode(',', (string)($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ''))[0]));
    $scheme = $forwardedProto === 'https'
    || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https'
        : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    $localImageUrl = $scheme . '://' . $host . '/images/developer.webp';

    $stories = [
        ['author' => 'Alya Prameswari', 'title' => 'Persephone dan Biji Delima', 'description' => 'Kisah tentang Persephone, musim yang berubah, dan kesepakatan yang menghubungkan dunia manusia dengan dunia bawah.', 'reading_time_minutes' => 7, 'reader_count' => 12800],
        ['author' => 'Raka Mahendra', 'title' => 'Fenrir dan Rantai Gleipnir', 'description' => 'Serigala Fenrir tumbuh semakin kuat hingga para dewa mencari cara untuk menahannya tanpa melupakan janji mereka.', 'reading_time_minutes' => 8, 'reader_count' => 9400],
        ['author' => 'Nadia Kirana', 'title' => 'Ra Menempuh Malam', 'description' => 'Dewa matahari Ra berlayar melewati Duat setiap malam untuk menghadapi kekuatan gelap dan membawa fajar kembali.', 'reading_time_minutes' => 6, 'reader_count' => 15700],
        ['author' => 'Dimas Wicaksono', 'title' => 'Nyi Roro Kidul dan Laut Selatan', 'description' => 'Legenda penguasa Laut Selatan yang dikenal dari kisah-kisah Jawa tentang samudra, keberanian, dan janji.', 'reading_time_minutes' => 9, 'reader_count' => 22100],
        ['author' => 'Sinta Puspita', 'title' => 'Thor dan Palu Mjolnir', 'description' => 'Thor menempuh perjalanan untuk mendapatkan kembali Mjolnir dan melindungi para dewa dari para raksasa.', 'reading_time_minutes' => 7, 'reader_count' => 18300],
        ['author' => 'Bima Adinata', 'title' => 'Amaterasu dan Gua Batu', 'description' => 'Saat Amaterasu bersembunyi di dalam gua, para dewa bekerja sama untuk mengundang cahaya kembali ke dunia.', 'reading_time_minutes' => 6, 'reader_count' => 11600],
        ['author' => 'Ratih Anggraini', 'title' => 'Garuda dan Air Amerta', 'description' => 'Garuda menjalani perjalanan berbahaya demi membebaskan ibunya dan menemukan air kehidupan yang dijaga para dewa.', 'reading_time_minutes' => 8, 'reader_count' => 20400],
        ['author' => 'Fajar Pratama', 'title' => 'Orpheus Menyusuri Dunia Bawah', 'description' => 'Dengan musiknya, Orpheus mencoba membawa Eurydice pulang dan harus menjaga kepercayaan sampai perjalanan berakhir.', 'reading_time_minutes' => 7, 'reader_count' => 16900],
        ['author' => 'Maya Sekar', 'title' => 'Anansi dan Kisah-Kisah Dunia', 'description' => 'Anansi si laba-laba menggunakan kecerdikan untuk mendapatkan kembali kisah-kisah yang tersebar di seluruh dunia.', 'reading_time_minutes' => 5, 'reader_count' => 8700],
        ['author' => 'Dewi Larasati', 'title' => 'Dewi Sri dan Asal Mula Padi', 'description' => 'Legenda Dewi Sri menceritakan hadirnya padi dan harapan akan kehidupan yang cukup bagi masyarakat.', 'reading_time_minutes' => 6, 'reader_count' => 24300],
        ['author' => 'Arman Nugraha', 'title' => 'Gilgamesh Mencari Keabadian', 'description' => 'Raja Gilgamesh memulai perjalanan panjang setelah kehilangan sahabatnya dan belajar memahami arti kehidupan.', 'reading_time_minutes' => 10, 'reader_count' => 13900],
        ['author' => 'Luna Kartika', 'title' => 'Putri Kaguya dari Bulan', 'description' => 'Seorang pemotong bambu menemukan bayi bercahaya yang tumbuh menjadi Putri Kaguya dengan asal-usul misterius.', 'reading_time_minutes' => 7, 'reader_count' => 19500],
        ['author' => 'Yoga Santoso', 'title' => 'Maui Mengangkat Pulau', 'description' => 'Maui menggunakan kail ajaibnya untuk menarik pulau-pulau dari lautan dan memberi tempat baru bagi manusia.', 'reading_time_minutes' => 6, 'reader_count' => 10200],
        ['author' => 'Kirana Putri', 'title' => 'Bima dan Naga Penjaga Amerta', 'description' => 'Bima menyelami samudra dan bertemu penjaga yang menguji keteguhan hatinya dalam pencarian air kehidupan.', 'reading_time_minutes' => 8, 'reader_count' => 17600],
        ['author' => 'Rendi Saputra', 'title' => 'Sangkuriang dan Perahu Terbalik', 'description' => 'Legenda Sangkuriang mengisahkan tugas yang mustahil, sebuah perahu besar, dan asal-usul gunung di tanah Sunda.', 'reading_time_minutes' => 9, 'reader_count' => 28700],
        ['author' => 'Intan Permata', 'title' => 'Isis Mencari Osiris', 'description' => 'Isis menempuh perjalanan untuk menemukan Osiris dan memulihkan keseimbangan setelah sebuah pengkhianatan.', 'reading_time_minutes' => 8, 'reader_count' => 11400],
        ['author' => 'Galih Wiratama', 'title' => 'Heracles dan Tugas-Tugasnya', 'description' => 'Heracles menghadapi serangkaian tugas berat yang menguji kekuatan, kecerdikan, dan ketabahannya.', 'reading_time_minutes' => 10, 'reader_count' => 23100],
        ['author' => 'Nirmala Sari', 'title' => 'Barong dan Rangda', 'description' => 'Pertarungan Barong dan Rangda menggambarkan keseimbangan kekuatan yang terus hadir dalam cerita Bali.', 'reading_time_minutes' => 7, 'reader_count' => 19200],
        ['author' => 'Kevin Darmawan', 'title' => 'Sun Wukong Menantang Langit', 'description' => 'Raja Kera Sun Wukong menolak tunduk pada aturan langit dan memulai petualangan yang penuh kekacauan.', 'reading_time_minutes' => 9, 'reader_count' => 31800],
        ['author' => 'Ayu Maharani', 'title' => 'Loki dan Rahasia Baldr', 'description' => 'Sebuah ramalan dan tipu daya Loki mengubah nasib Baldr serta mengguncang dunia para dewa Nordik.', 'reading_time_minutes' => 8, 'reader_count' => 14700],
        ['author' => 'Bagas Prakoso', 'title' => 'Nyai Pohaci Sanghyang Asri', 'description' => 'Kisah Sunda tentang Nyai Pohaci menghubungkan kesuburan bumi dengan tumbuhnya tanaman pangan.', 'reading_time_minutes' => 6, 'reader_count' => 9600],
        ['author' => 'Tara Wulandari', 'title' => 'Pegasus dan Mata Air Hippocrene', 'description' => 'Kuda bersayap Pegasus menapakkan kaki di gunung dan menghadirkan mata air yang dikaitkan dengan para pujangga.', 'reading_time_minutes' => 5, 'reader_count' => 12500],
        ['author' => 'Rizky Ramadhan', 'title' => 'Perseus Menghadapi Medusa', 'description' => 'Perseus menerima perlengkapan para dewa dan menyusun siasat untuk menghadapi Medusa tanpa menatap langsung.', 'reading_time_minutes' => 8, 'reader_count' => 26800],
        ['author' => 'Sari Kusuma', 'title' => 'Pangu Membelah Langit dan Bumi', 'description' => 'Dalam kisah penciptaan Tiongkok, Pangu memisahkan langit dari bumi dan membentuk dunia dari tubuhnya.', 'reading_time_minutes' => 7, 'reader_count' => 11000],
        ['author' => 'Eka Firmansyah', 'title' => 'Calon Arang dan Kerajaan Kediri', 'description' => 'Legenda Calon Arang berkisah tentang kekuatan ilmu, ketakutan warga, dan usaha memulihkan ketenteraman kerajaan.', 'reading_time_minutes' => 9, 'reader_count' => 21400],
        ['author' => 'Nisa Rahmawati', 'title' => 'Odysseus dan Nyanyian Siren', 'description' => 'Dalam perjalanan pulang, Odysseus harus melewati nyanyian Siren dengan rencana yang menguji kecerdikannya.', 'reading_time_minutes' => 7, 'reader_count' => 17800],
        ['author' => 'Rama Wijaya', 'title' => 'Saraswati Membawa Pengetahuan', 'description' => 'Dewi Saraswati dikenal sebagai lambang ilmu, seni, dan kebijaksanaan yang membantu manusia belajar.', 'reading_time_minutes' => 5, 'reader_count' => 15100],
        ['author' => 'Citra Lestari', 'title' => 'Hanuman Melompat ke Alengka', 'description' => 'Hanuman melintasi samudra untuk mencari Sita dan membawa kabar bagi Rama dari negeri Alengka.', 'reading_time_minutes' => 8, 'reader_count' => 29200],
        ['author' => 'Danu Prabowo', 'title' => 'Quetzalcoatl Sang Ular Berbulu', 'description' => 'Quetzalcoatl hadir dalam kisah Mesoamerika sebagai sosok ilahi yang berkaitan dengan angin dan penciptaan.', 'reading_time_minutes' => 6, 'reader_count' => 8300],
        ['author' => 'Mira Anjani', 'title' => 'Athena dan Arachne', 'description' => 'Arachne menantang Athena dalam perlombaan menenun yang berakhir menjadi peringatan tentang kesombongan.', 'reading_time_minutes' => 6, 'reader_count' => 13200],
        ['author' => 'Wahyu Hidayat', 'title' => 'Jaka Tarub dan Nawang Wulan', 'description' => 'Jaka Tarub bertemu seorang bidadari dan membuat keputusan yang mengubah kehidupan mereka berdua.', 'reading_time_minutes' => 8, 'reader_count' => 26700],
        ['author' => 'Larasati Ningsih', 'title' => 'Burung Phoenix dan Api Baru', 'description' => 'Phoenix menjadi lambang pembaruan melalui kisah burung yang kembali hidup setelah terbakar menjadi abu.', 'reading_time_minutes' => 5, 'reader_count' => 19900],
        ['author' => 'Hendra Kurniawan', 'title' => 'Cindelaras dan Ayam Ajaib', 'description' => 'Cindelaras membawa ayam jago yang istimewa ke istana dan membuka rahasia tentang asal-usul keluarganya.', 'reading_time_minutes' => 7, 'reader_count' => 14300],
        ['author' => 'Putri Amelia', 'title' => 'Enkidu dan Persahabatan Gilgamesh', 'description' => 'Pertemuan Enkidu dan Gilgamesh mengubah seorang raja yang angkuh menjadi sahabat dan pemimpin yang lebih bijak.', 'reading_time_minutes' => 9, 'reader_count' => 11800],
        ['author' => 'Daffa Maulana', 'title' => 'Ymir dan Lahirnya Dunia Nordik', 'description' => 'Dari kisah Ymir, mitologi Nordik menjelaskan bagaimana para dewa membentuk dunia dari kekacauan awal.', 'reading_time_minutes' => 7, 'reader_count' => 10500],
        ['author' => 'Sekar Ayuningtyas', 'title' => 'Nawang Wulan dan Selendang yang Hilang', 'description' => 'Kisah bidadari yang kehilangan selendangnya menceritakan pertemuan dua dunia dan kerinduan untuk pulang.', 'reading_time_minutes' => 6, 'reader_count' => 16100],
        ['author' => 'Farhan Akbar', 'title' => 'Chang’e dan Istana Bulan', 'description' => 'Chang’e meminum ramuan keabadian dan tinggal di bulan, meninggalkan kisah yang dikenang saat festival musim gugur.', 'reading_time_minutes' => 6, 'reader_count' => 22400],
        ['author' => 'Mei Lestari', 'title' => 'Rama dan Jembatan Menuju Alengka', 'description' => 'Rama dan para sekutunya membangun jalan melintasi laut untuk menghadapi Rahwana dan mencari Sita.', 'reading_time_minutes' => 10, 'reader_count' => 33700],
        ['author' => 'Andra Pamungkas', 'title' => 'Tantalus dan Hidangan yang Tak Terjangkau', 'description' => 'Hukuman Tantalus menjadi kisah tentang keserakahan dan keinginan yang selalu berada di luar jangkauan.', 'reading_time_minutes' => 5, 'reader_count' => 7600],
    ];

    $items = [];
    foreach ($stories as $index => $story) {
        $id = $index + 1;
        $image = match ($id) {
            1 => 'https://picsum.photos/id/1018/900/600',
            2 => 'https://missing-image.invalid/item-2.jpg',
            3 => 'https://picsum.photos/id/1015/900/600',
            4 => $localImageUrl,
            default => 'https://picsum.photos/seed/mythology-story-' . $id . '/900/600',
        };

        $items[] = ['id' => $id] + $story + ['image' => $image];
    }

    return $items;
}
