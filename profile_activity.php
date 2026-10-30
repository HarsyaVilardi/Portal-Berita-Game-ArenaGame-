<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$activities = [
    'read' => [
        'title' => 'Artikel Dibaca',
        'empty_message' => 'Belum ada riwayat artikel yang dapat ditampilkan.',
    ],
    'comments' => [
        'title' => 'Komentar Saya',
        'empty_message' => 'Anda belum memiliki komentar.',
    ],
    'bookmarks' => [
        'title' => 'Bookmark Saya',
        'empty_message' => 'Anda belum memiliki artikel yang di-bookmark.',
    ],
];

$activity_type = filter_input(INPUT_GET, 'type', FILTER_UNSAFE_RAW);
if (!is_string($activity_type) || !isset($activities[$activity_type])) {
    http_response_code(404);
    $activity_type = null;
    $page_title = 'Aktivitas tidak ditemukan';
} else {
    $page_title = $activities[$activity_type]['title'];
}

$bookmarked_articles = [];
$read_articles = [];
if ($activity_type === 'bookmarks') {
    require_once 'config/database.php';
    ensureUserBookmarksTable();

    if (!isset($_SESSION['bookmark_token'])) {
        $_SESSION['bookmark_token'] = bin2hex(random_bytes(32));
    }
    $bookmark_token = $_SESSION['bookmark_token'];

    $article_titles = require 'includes/news_articles.php';
    $article_categories = [
        1 => 'Turnamen',
        2 => 'Turnamen',
        3 => 'Update',
        4 => 'Turnamen',
        5 => 'Update',
        6 => 'Campus',
        7 => 'Mobile Legends',
        8 => 'Valorant',
        9 => 'Dota 2',
        10 => 'Review',
        11 => 'Update',
    ];
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT article_id, created_at FROM user_bookmarks WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($bookmark = $result->fetch_assoc()) {
        $article_id = (int) $bookmark['article_id'];
        if (isset($article_titles[$article_id])) {
            $bookmarked_articles[] = [
                'id' => $article_id,
                'title' => $article_titles[$article_id],
                'category' => $article_categories[$article_id],
                'created_at' => $bookmark['created_at'],
            ];
        }
    }

    $stmt->close();
} elseif ($activity_type === 'read') {
    require_once 'config/database.php';
    ensureUserArticleReadsTable();

    $article_titles = require 'includes/news_articles.php';
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT article_id, awarded_points, created_at FROM user_article_reads WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($read = $result->fetch_assoc()) {
        $article_id = (int) $read['article_id'];
        if (isset($article_titles[$article_id])) {
            $read_articles[] = [
                'id' => $article_id,
                'title' => $article_titles[$article_id],
                'points' => (int) $read['awarded_points'],
                'created_at' => $read['created_at'],
            ];
        }
    }

    $stmt->close();
}

include 'includes/header.php';
?>

<main class="min-h-screen py-20">
    <div class="container mx-auto max-w-4xl px-4">
        <a href="profile.php" class="mb-8 inline-flex items-center text-sm font-semibold text-primary hover:underline">
            &larr; Kembali ke profil
        </a>

        <section class="rounded-lg bg-dark p-8 shadow-2xl">
            <?php if ($activity_type === null): ?>
                <h1 class="mb-4 text-3xl font-bold">Aktivitas tidak ditemukan</h1>
                <p class="mb-6 text-gray-400">Halaman aktivitas yang Anda cari tidak tersedia.</p>
            <?php else: ?>
                <h1 class="mb-4 text-3xl font-bold"><?php echo htmlspecialchars($activities[$activity_type]['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <?php if ($activity_type === 'bookmarks' && isset($_GET['bookmark'])): ?>
                    <?php
                    $bookmark_notice = $_GET['bookmark'] === 'removed'
                        ? 'Bookmark berhasil dihapus.'
                        : ($_GET['bookmark'] === 'error' ? 'Bookmark gagal dihapus. Silakan coba lagi.' : '');
                    ?>
                    <?php if ($bookmark_notice !== ''): ?>
                        <p class="mb-6 rounded-lg border border-primary bg-darker px-4 py-3 text-white" role="status">
                            <?php echo htmlspecialchars($bookmark_notice, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($activity_type === 'read' && $read_articles): ?>
                    <ul class="space-y-3">
                        <?php foreach ($read_articles as $read): ?>
                            <li class="flex flex-col gap-2 rounded-lg border border-gray-700 bg-darker p-4 sm:flex-row sm:items-center sm:justify-between">
                                <a href="news.php?id=<?php echo (int) $read['id']; ?>" class="font-semibold text-white hover:text-primary">
                                    <?php echo htmlspecialchars($read['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                                <span class="shrink-0 text-sm text-gray-400">
                                    +<?php echo (int) $read['points']; ?> poin · <?php echo htmlspecialchars(date('d M Y', strtotime($read['created_at'])), ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php elseif ($activity_type === 'bookmarks' && $bookmarked_articles): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[640px] border-collapse text-left">
                            <thead>
                                <tr class="border-b border-gray-700 text-sm text-gray-400">
                                    <th scope="col" class="w-12 px-3 py-3 text-right font-medium">#</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Judul</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Kategori</th>
                                    <th scope="col" class="px-3 py-3 font-medium">Tanggal disimpan</th>
                                    <th scope="col" class="px-3 py-3 text-right font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookmarked_articles as $index => $bookmark): ?>
                                    <?php
                                    $article_image = 'assets/images/news/berita-' . $bookmark['id'] . '.jpg';
                                    $article_image_path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $article_image);
                                    ?>
                                    <tr class="group border-b border-gray-800 transition-colors hover:bg-white/5">
                                        <td class="px-3 py-3 text-right text-gray-400"><?php echo $index + 1; ?></td>
                                        <td class="px-3 py-3">
                                            <a href="news.php?id=<?php echo (int) $bookmark['id']; ?>" class="flex min-w-0 items-center gap-4">
                                                <?php if (is_file($article_image_path)): ?>
                                                    <img
                                                        src="<?php echo htmlspecialchars($article_image, ENT_QUOTES, 'UTF-8'); ?>"
                                                        alt=""
                                                        class="h-12 w-16 shrink-0 rounded object-cover"
                                                    >
                                                <?php else: ?>
                                                    <span class="h-12 w-16 shrink-0 rounded bg-gradient-to-br from-primary/40 to-gray-800"></span>
                                                <?php endif; ?>
                                                <span class="min-w-0">
                                                    <span class="block font-semibold text-white group-hover:text-primary">
                                                        <?php echo htmlspecialchars($bookmark['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </span>
                                                    <span class="block text-sm text-gray-400">ArenaGame</span>
                                                </span>
                                            </a>
                                        </td>
                                        <td class="px-3 py-3 text-gray-300"><?php echo htmlspecialchars($bookmark['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-3 py-3 text-gray-400"><?php echo htmlspecialchars(date('d M Y', strtotime($bookmark['created_at'])), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-3 py-3 text-right">
                                            <form action="processes/handle_bookmark.php" method="POST">
                                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($bookmark_token, ENT_QUOTES, 'UTF-8'); ?>">
                                                <input type="hidden" name="article_id" value="<?php echo (int) $bookmark['id']; ?>">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="return_to" value="bookmarks">
                                                <button type="submit" class="rounded border border-gray-700 px-3 py-2 text-sm font-semibold text-gray-300 transition-colors hover:border-primary hover:text-primary">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="rounded-lg border border-gray-700 bg-darker px-6 py-10 text-center">
                        <p class="text-gray-400"><?php echo htmlspecialchars($activities[$activity_type]['empty_message'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <a href="index.php#latest" class="mt-6 inline-flex rounded-lg bg-primary px-6 py-3 font-semibold text-white transition-colors hover:bg-red-600">
                Jelajahi berita
            </a>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
