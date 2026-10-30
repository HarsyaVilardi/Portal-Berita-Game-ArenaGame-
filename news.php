<?php
session_start();
require_once 'config/database.php';
$article_titles = require 'includes/news_articles.php';

$bookmark_token = null;
if (isset($_SESSION['user_id'])) {
    ensureUserBookmarksTable();
    if (!isset($_SESSION['bookmark_token'])) {
        $_SESSION['bookmark_token'] = bin2hex(random_bytes(32));
    }
    $bookmark_token = $_SESSION['bookmark_token'];
}

$articles = [
    1 => [
        'title' => $article_titles[1],
        'category' => 'Turnamen',
        'date' => '24 Maret 2025',
        'paragraphs' => [
            'Liga Esports Nasional Pelajar 2025 mencapai babak puncak dengan mempertemukan tim-tim pelajar terbaik. SMK Harapan Bangsa tampil konsisten sepanjang kompetisi hingga akhirnya meraih gelar juara.',
            'Perjalanan menuju kemenangan tidak lepas dari koordinasi tim, strategi yang matang, dan kemampuan beradaptasi di setiap pertandingan. Hasil ini menjadi pencapaian penting bagi para pemain sekaligus kebanggaan bagi sekolah mereka.',
            'Turnamen pelajar seperti ini memberi ruang bagi generasi muda untuk mengembangkan kemampuan bermain secara kompetitif dan menjunjung sportivitas.'
        ]
    ],
    2 => [
        'title' => $article_titles[2],
        'category' => 'Turnamen',
        'date' => '23 Maret 2025',
        'paragraphs' => [
            'Perubahan roster Talen di YCT Pacific memunculkan banyak diskusi tentang siapa yang akan mengisi posisi tersebut. Nama Fall Bottom dan Suframi menjadi beberapa kandidat yang ramai diperbincangkan oleh penggemar.',
            'Pemilihan pemain pengganti biasanya mempertimbangkan kecocokan gaya bermain, pengalaman di kompetisi, serta kebutuhan strategi tim. Karena belum ada pengumuman resmi dalam informasi pada kartu ini, nama-nama tersebut masih sebatas kandidat yang dibicarakan.',
            'Penggemar kini menantikan konfirmasi dari tim dan bagaimana perubahan roster akan memengaruhi persiapan YCT Pacific untuk pertandingan berikutnya.'
        ]
    ],
    3 => [
        'title' => $article_titles[3],
        'category' => 'Update',
        'date' => '22 Maret 2025',
        'paragraphs' => [
            'The Game Awards menjadi salah satu acara tahunan yang dinantikan komunitas game. Acara ini menyoroti berbagai karya dan pencapaian industri, sekaligus menjadi tempat pengumuman game baru.',
            'Menjelang edisi 2025, informasi tentang venue, jadwal, dan mekanisme penilaian menjadi perhatian penonton. Sistem juri dan suara publik biasanya berperan dalam menentukan hasil pada kategori-kategori tertentu.',
            'Pantau pengumuman resmi penyelenggara untuk memperoleh detail terbaru mengenai waktu siaran, lokasi, dan tata cara pemilihan pemenang.'
        ]
    ],
    4 => [
        'title' => $article_titles[4],
        'category' => 'Turnamen',
        'date' => '21 Maret 2025',
        'paragraphs' => [
            'Sejumlah tim Indonesia yang disebut dalam kartu berita ini bersiap membawa nama Tanah Air ke APAC Predator League 2025. Turnamen regional tersebut menjadi kesempatan untuk menguji kemampuan melawan tim dari berbagai negara Asia Pasifik.',
            'Persiapan menuju kompetisi internasional mencakup latihan strategi, koordinasi antarpemain, dan penyesuaian terhadap lawan. Konsistensi sepanjang pertandingan akan menjadi salah satu faktor penting dalam perjalanan setiap tim.',
            'Dukungan penggemar turut menambah semangat para wakil Indonesia saat berkompetisi di panggung regional.'
        ]
    ],
    5 => [
        'title' => $article_titles[5],
        'category' => 'Update',
        'date' => '20 Maret 2025',
        'paragraphs' => [
            'Kabar kepergian Gunayusi dari T1 menjadi salah satu topik besar yang dibicarakan selama offseason LCK 2025. Perubahan pemain inti dapat membawa dampak besar terhadap susunan tim dan rencana kompetitif untuk musim selanjutnya.',
            'Bagi T1, mencari pengganti yang sesuai bukan hanya soal kemampuan individu. Pemain baru juga perlu menyatu dengan komunikasi, strategi, dan ritme permainan tim.',
            'Pergerakan roster pada offseason akan terus menarik untuk diikuti, terutama saat tim-tim mulai mengumumkan susunan pemain dan target mereka.'
        ]
    ],
    6 => [
        'title' => $article_titles[6],
        'category' => 'Campus',
        'date' => '19 Maret 2025',
        'paragraphs' => [
            'Program Campus Ambassador dalam rangkaian Honor of Kings Invitational 2025 mengajak mahasiswa untuk terlibat lebih dekat dengan komunitas game dan esports di lingkungan kampus.',
            'Para peserta berkesempatan menunjukkan kreativitas, kemampuan komunikasi, serta kontribusi mereka dalam membangun kegiatan komunitas. Pemenang program ini kemudian mendapat pengakuan atas usaha dan partisipasinya.',
            'Kegiatan kampus dapat menjadi pintu masuk bagi pemain dan penggemar baru untuk mengenal esports, bertemu komunitas, dan ikut meramaikan acara game.'
        ]
    ],
    7 => [
        'title' => $article_titles[7],
        'category' => 'Mobile Legends',
        'date' => '18 Maret 2025',
        'paragraphs' => [
            'MPL Indonesia Season 14 mempertemukan tim-tim Mobile Legends dalam rangkaian pertandingan liga. Setiap pekan menjadi kesempatan bagi tim untuk mengumpulkan hasil penting dan memperbaiki posisi mereka di klasemen.',
            'Format kompetisi, jadwal pertandingan, serta daftar tim membantu penggemar mengikuti perjalanan musim ini. Perubahan strategi dan performa pemain dapat membuat persaingan semakin menarik dari satu pertandingan ke pertandingan berikutnya.',
            'Periksa kanal resmi MPL Indonesia untuk jadwal dan hasil pertandingan yang paling baru.'
        ]
    ],
    8 => [
        'title' => $article_titles[8],
        'category' => 'Valorant',
        'date' => '17 Maret 2025',
        'paragraphs' => [
            'Lolos ke babak playoff menjadi langkah penting bagi RRQ Hoshi dalam persaingan VCT Pacific 2025. Hasil tersebut membuka peluang untuk melanjutkan perjuangan menuju tahap akhir kompetisi.',
            'Di babak playoff, setiap ronde dan keputusan strategi dapat menentukan hasil pertandingan. Tim perlu menjaga komunikasi dan menyesuaikan pendekatan terhadap lawan yang juga telah melewati fase kompetitif.',
            'Para penggemar dapat mengikuti jadwal dan hasil terbaru melalui kanal resmi VCT Pacific.'
        ]
    ],
    9 => [
        'title' => $article_titles[9],
        'category' => 'Dota 2',
        'date' => '16 Maret 2025',
        'paragraphs' => [
            'BOOM Esports menutup perjalanan mereka di DPC SEA Tour 3 dengan meraih gelar juara. Pencapaian ini menjadi hasil dari kerja sama tim dan persiapan menghadapi rangkaian pertandingan yang kompetitif.',
            'Dalam Dota 2, pemilihan hero, penguasaan objektif, dan koordinasi saat team fight dapat mengubah jalannya pertandingan. Konsistensi di berbagai aspek tersebut membantu tim menjaga peluang hingga babak penentuan.',
            'Gelar ini menambah catatan prestasi BOOM Esports di kompetisi regional dan menjadi kabar gembira bagi pendukungnya.'
        ]
    ],
    10 => [
        'title' => $article_titles[10],
        'category' => 'Review',
        'date' => '15 Maret 2025',
        'paragraphs' => [
            'Grand Theft Auto VI menjadi salah satu game yang paling banyak dinantikan. Ekspektasi terhadap dunia terbuka, cerita, dan kebebasan bermain membuat banyak pemain bertanya-tanya apakah game ini akan menjadi pengalaman terbaik di tahun 2025.',
            'Sebuah penilaian menyeluruh perlu melihat lebih dari sekadar skala dunia game. Kualitas misi, karakter, performa, aksesibilitas, dan seberapa menarik aktivitas di luar cerita utama juga ikut menentukan pengalaman pemain.',
            'Artikel ini mengangkat pertanyaan yang ada pada kartu berita. Kesimpulan akhir sebaiknya menunggu game tersedia dan dinilai berdasarkan pengalaman bermain langsung.'
        ]
    ],
    11 => [
        'title' => $article_titles[11],
        'category' => 'Update',
        'date' => '14 Maret 2025',
        'paragraphs' => [
            'Pembaruan Genshin Impact 5.0 pada kartu berita ini menyoroti kehadiran region baru. Wilayah baru biasanya membawa area untuk dijelajahi, karakter yang ditemui, serta rangkaian cerita dan tantangan tambahan.',
            'Pembaruan besar juga menjadi kesempatan bagi pemain untuk mencoba mekanik dan aktivitas baru. Pastikan ruang penyimpanan dan versi game sudah siap sebelum mengunduh pembaruan.',
            'Untuk detail fitur, jadwal pemeliharaan, dan catatan patch yang akurat, periksa pengumuman resmi HoYoverse.'
        ]
    ],
    12 => [
        'title' => $article_titles[12],
        'category' => 'Rekomendasi',
        'date' => '13 Maret 2025',
        'paragraphs' => [
            'Game indie menawarkan beragam pengalaman, mulai dari petualangan dengan cerita personal hingga tantangan yang mengandalkan kreativitas. Banyak di antaranya hadir dengan gaya visual dan mekanik yang berbeda dari game beranggaran besar.',
            'Saat memilih game untuk wishlist, perhatikan genre, platform yang didukung, dan informasi dari pengembang. Demo atau cuplikan gameplay dapat membantu menentukan apakah sebuah game sesuai dengan selera bermain Anda.',
            'Daftar rekomendasi ini bisa menjadi titik awal untuk menemukan judul baru. Cek halaman resmi masing-masing game untuk informasi ketersediaan dan tanggal rilis.'
        ]
    ],
    13 => [
        'title' => $article_titles[13],
        'category' => 'Tips',
        'date' => '12 Maret 2025',
        'paragraphs' => [
            'Jika game terasa kurang lancar, menyesuaikan pengaturan grafis dapat membantu menemukan keseimbangan antara kualitas visual dan performa. Mulailah dengan preset yang sesuai kemampuan perangkat.',
            'Coba turunkan resolusi, bayangan, atau efek visual secara bertahap, lalu periksa perubahan performa di dalam game. Menutup aplikasi lain yang tidak diperlukan juga dapat membantu menyediakan lebih banyak sumber daya.',
            'Setiap perangkat dan game memiliki karakteristik berbeda. Uji perubahan satu per satu agar Anda bisa memilih pengaturan yang terasa paling nyaman.'
        ]
    ],
    14 => [
        'title' => $article_titles[14],
        'category' => 'Co-op',
        'date' => '11 Maret 2025',
        'paragraphs' => [
            'Game co-op memberi kesempatan untuk bekerja sama menyelesaikan misi, memecahkan teka-teki, atau bertahan menghadapi tantangan. Pilihan yang tepat bergantung pada jumlah pemain dan jenis pengalaman yang dicari.',
            'Sebelum bermain, periksa dukungan platform, jumlah pemain, serta apakah game menyediakan mode online atau lokal. Informasi ini membantu memastikan semua teman dapat ikut bermain.',
            'Komunikasi dan kerja sama sering menjadi bagian paling seru dari permainan co-op. Pilih tingkat kesulitan yang cocok untuk seluruh kelompok agar sesi bermain tetap menyenangkan.'
        ]
    ],
    15 => [
        'title' => $article_titles[15],
        'category' => 'RPG',
        'date' => '10 Maret 2025',
        'paragraphs' => [
            'Game RPG dunia terbuka menggabungkan perkembangan karakter dengan kebebasan menjelajahi lingkungan permainan. Pemain dapat mengikuti cerita utama atau meluangkan waktu untuk menemukan misi dan lokasi tambahan.',
            'Desain dunia, pilihan pemain, sistem pertarungan, dan aktivitas sampingan membentuk pengalaman yang berbeda di setiap judul. Elemen-elemen tersebut juga menjadi fokus pengembangan RPG modern.',
            'Bagi pemain yang tertarik mencoba genre ini, periksa deskripsi dan cuplikan gameplay untuk menemukan dunia dan gaya bermain yang sesuai.'
        ]
    ]
];

$article_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$article = $article_id !== false && $article_id !== null
    ? ($articles[$article_id] ?? null)
    : null;

if ($article === null) {
    http_response_code(404);
    $page_title = 'Berita tidak ditemukan';
} else {
    $page_title = $article['title'];
}

$return_section = $_GET['section'] ?? 'latest';
if (!is_string($return_section) || !in_array($return_section, ['latest', 'esports', 'games'], true)) {
    $return_section = 'latest';
}

$read_points = 0;
$points_awarded = false;
if ($article !== null && isset($_SESSION['user_id'])) {
    ensureUserArticleReadsTable();
    $read_points = in_array($article['category'], ['Turnamen', 'Mobile Legends', 'Valorant', 'Dota 2'], true) ? 10 : 5;
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT IGNORE INTO user_article_reads (user_id, article_id, awarded_points) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $_SESSION['user_id'], $article_id, $read_points);
    if (!$stmt->execute()) {
        throw new RuntimeException("Gagal mencatat pembacaan artikel: " . $stmt->error);
    }
    $points_awarded = $stmt->affected_rows === 1;
    $stmt->close();
}

$is_bookmarked = false;
if ($article !== null && isset($_SESSION['user_id'])) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id FROM user_bookmarks WHERE user_id = ? AND article_id = ?");
    $stmt->bind_param("ii", $_SESSION['user_id'], $article_id);
    $stmt->execute();
    $is_bookmarked = $stmt->get_result()->num_rows > 0;
    $stmt->close();
}

include 'includes/header.php';
?>

<main class="min-h-screen py-16">
    <div class="container mx-auto max-w-4xl px-4">
        <?php
        $bookmark_notice = '';
        if (isset($_GET['bookmark'])) {
            if ($_GET['bookmark'] === 'saved') {
                $bookmark_notice = 'Artikel berhasil disimpan ke bookmark.';
            } elseif ($_GET['bookmark'] === 'removed') {
                $bookmark_notice = 'Artikel dihapus dari bookmark.';
            } elseif ($_GET['bookmark'] === 'error') {
                $bookmark_notice = 'Bookmark gagal diperbarui. Silakan coba lagi.';
            }
        }
        ?>
        <?php if ($bookmark_notice !== ''): ?>
            <p class="mb-6 rounded-lg border border-primary bg-dark px-4 py-3 text-white" role="status">
                <?php echo htmlspecialchars($bookmark_notice, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>
        <?php if ($article !== null && isset($_SESSION['user_id'])): ?>
            <p class="mb-6 rounded-lg border border-gray-700 bg-dark px-4 py-3 text-gray-300">
                <?php if ($points_awarded): ?>
                    Anda mendapatkan <?php echo $read_points; ?> poin dari membaca artikel ini.
                <?php else: ?>
                    Poin untuk artikel ini sudah pernah diterima.
                <?php endif; ?>
            </p>
        <?php endif; ?>

        <a
            href="news_list.php?section=<?php echo htmlspecialchars($return_section, ENT_QUOTES, 'UTF-8'); ?>"
            data-escape-back
            class="mb-8 inline-flex items-center text-sm font-semibold text-primary hover:underline"
        >
            &larr; Kembali ke daftar berita
        </a>

        <?php if ($article === null): ?>
            <section class="rounded-lg bg-dark p-8 text-center">
                <h1 class="mb-4 text-3xl font-bold">Berita tidak ditemukan</h1>
                <p class="mb-6 text-gray-400">Berita yang Anda cari tidak tersedia atau tautannya tidak valid.</p>
                <a
                    href="news_list.php"
                    class="inline-block rounded-lg bg-primary px-6 py-3 font-semibold text-white hover:bg-red-600"
                >
                    Lihat semua berita
                </a>
            </section>
        <?php else: ?>
            <article class="rounded-lg bg-dark p-6 shadow-xl md:p-10">
                <?php
                $article_image = 'assets/images/news/berita-' . $article_id . '.jpg';
                $article_image_path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $article_image);
                ?>
                <figure class="mb-8 overflow-hidden rounded-lg">
                    <?php if (is_file($article_image_path)): ?>
                        <img
                            src="<?php echo htmlspecialchars($article_image, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>"
                            class="aspect-video w-full object-cover"
                        >
                    <?php else: ?>
                        <div class="flex aspect-video w-full flex-col items-center justify-center gap-3 bg-gradient-to-br from-gray-800 to-darker text-gray-400">
                            <svg
                                class="h-12 w-12"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V5.25zM3.75 16.5l4.5-4.5a1.5 1.5 0 012.121 0l2.379 2.379 1.629-1.629a1.5 1.5 0 012.121 0l3.75 3.75M15.75 8.25h.008v.008h-.008V8.25z"
                                />
                            </svg>
                            <span class="text-sm">Slot foto berita</span>
                        </div>
                    <?php endif; ?>
                    <figcaption class="sr-only">Foto untuk berita ini</figcaption>
                </figure>

                <div class="mb-6">
                    <span class="badge"><?php echo htmlspecialchars($article['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <p class="mt-4 text-sm text-gray-400"><?php echo htmlspecialchars($article['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>

                <h1 class="mb-8 text-3xl font-bold leading-tight md:text-4xl">
                    <?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>
                </h1>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="processes/handle_bookmark.php" method="POST" class="mb-8">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($bookmark_token, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="article_id" value="<?php echo (int) $article_id; ?>">
                        <input type="hidden" name="action" value="<?php echo $is_bookmarked ? 'remove' : 'save'; ?>">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-primary px-5 py-3 font-semibold text-white transition-colors hover:bg-primary">
                            <svg class="h-5 w-5" fill="<?php echo $is_bookmarked ? 'currentColor' : 'none'; ?>" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <?php echo $is_bookmarked ? 'Hapus dari Bookmark' : 'Simpan Bookmark'; ?>
                        </button>
                    </form>
                <?php else: ?>
                    <p class="mb-8 text-gray-400">
                        <a href="login.php" class="font-semibold text-primary hover:underline">Login</a> untuk menyimpan artikel ke bookmark.
                    </p>
                <?php endif; ?>

                <div class="space-y-5 text-lg leading-relaxed text-gray-300">
                    <?php foreach ($article['paragraphs'] as $paragraph): ?>
                        <p><?php echo htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            </article>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
