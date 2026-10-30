<?php
session_start();
$article_titles = require 'includes/news_articles.php';

$articles = [
    1 => ['category' => 'Turnamen', 'date' => '24 Maret 2025'],
    2 => ['category' => 'Turnamen', 'date' => '23 Maret 2025'],
    3 => ['category' => 'Update', 'date' => '22 Maret 2025'],
    4 => ['category' => 'Turnamen', 'date' => '21 Maret 2025'],
    5 => ['category' => 'Update', 'date' => '20 Maret 2025'],
    6 => ['category' => 'Campus', 'date' => '19 Maret 2025'],
    7 => ['category' => 'Mobile Legends', 'date' => '18 Maret 2025'],
    8 => ['category' => 'Valorant', 'date' => '17 Maret 2025'],
    9 => ['category' => 'Dota 2', 'date' => '16 Maret 2025'],
    10 => ['category' => 'Review', 'date' => '15 Maret 2025'],
    11 => ['category' => 'Update', 'date' => '14 Maret 2025'],
    12 => ['category' => 'Rekomendasi', 'date' => '13 Maret 2025'],
    13 => ['category' => 'Tips', 'date' => '12 Maret 2025'],
    14 => ['category' => 'Co-op', 'date' => '11 Maret 2025'],
    15 => ['category' => 'RPG', 'date' => '10 Maret 2025'],
];

$sections = [
    'latest' => [
        'title' => 'Berita Terbaru',
        'home_anchor' => 'latest',
        'article_ids' => [1, 2, 3, 4, 5, 6],
    ],
    'esports' => [
        'title' => 'Esports Highlight',
        'home_anchor' => 'esports',
        'article_ids' => [7, 8, 9],
    ],
    'games' => [
        'title' => 'Berita Games',
        'home_anchor' => 'games',
        'article_ids' => [10, 11, 12, 13, 14, 15],
    ],
];
$section = filter_input(INPUT_GET, 'section', FILTER_UNSAFE_RAW);
if ($section === null) {
    $section = 'latest';
}
if (!is_string($section) || !isset($sections[$section])) {
    http_response_code(404);
    $section = null;
    $page_title = 'Halaman berita tidak ditemukan';
    $section_articles = [];
} else {
    $page_title = $sections[$section]['title'];
    $section_articles = array_intersect_key($articles, array_flip($sections[$section]['article_ids']));
}

include 'includes/header.php';
?>

<main class="min-h-screen py-16">
    <section class="container mx-auto px-4">
        <a
            href="<?php
                echo $section === null || $section === 'games'
                    ? 'index.php'
                    : 'index.php#' . htmlspecialchars($sections[$section]['home_anchor'], ENT_QUOTES, 'UTF-8');
            ?>"
            data-escape-back
            class="mb-8 inline-flex items-center text-sm font-semibold text-primary hover:underline"
        >
            &larr; Kembali
        </a>

        <?php if ($section === null): ?>
            <h1 class="mb-4 text-3xl font-bold">Halaman berita tidak ditemukan</h1>
            <p class="mb-8 text-gray-400">Kategori berita yang Anda cari tidak tersedia.</p>
        <?php else: ?>
            <h1 class="mb-8 text-3xl font-bold"><?php echo htmlspecialchars($sections[$section]['title'], ENT_QUOTES, 'UTF-8'); ?></h1>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($section_articles as $article_id => $details): ?>
                <?php
                $article_image = 'assets/images/news/berita-' . $article_id . '.jpg';
                $article_image_path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $article_image);
                ?>
                <a href="news.php?id=<?php echo (int) $article_id; ?>&amp;section=<?php echo rawurlencode($section); ?>" class="block text-inherit no-underline">
                    <article class="news-card group h-full overflow-hidden rounded-lg bg-dark">
                        <div class="relative flex h-48 items-end overflow-hidden bg-gray-800">
                            <?php if (is_file($article_image_path)): ?>
                                <img
                                    src="<?php echo htmlspecialchars($article_image, ENT_QUOTES, 'UTF-8'); ?>"
                                    alt=""
                                    class="absolute inset-0 h-full w-full object-cover"
                                >
                            <?php else: ?>
                                <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                            <?php endif; ?>
                            <div class="card-overlay"></div>
                            <span class="badge absolute left-4 top-4"><?php echo htmlspecialchars($details['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <h2 class="relative z-10 p-4 text-lg font-bold text-white transition-colors group-hover:text-primary">
                                <?php echo htmlspecialchars($article_titles[$article_id], ENT_QUOTES, 'UTF-8'); ?>
                            </h2>
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-400"><?php echo htmlspecialchars($details['date'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </article>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
