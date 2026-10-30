<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$article_id = filter_input(INPUT_POST, 'article_id', FILTER_VALIDATE_INT);
$article_titles = require '../includes/news_articles.php';
$action = $_POST['action'] ?? '';
$csrf_token = $_POST['csrf_token'] ?? '';
$return_to_bookmarks = ($_POST['return_to'] ?? '') === 'bookmarks';

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST'
    || $article_id === false
    || $article_id === null
    || !isset($article_titles[$article_id])
    || !is_string($csrf_token)
    || !isset($_SESSION['bookmark_token'])
    || !is_string($_SESSION['bookmark_token'])
    || !hash_equals($_SESSION['bookmark_token'], $csrf_token)
    || !in_array($action, ['save', 'remove'], true)
) {
    $status = 'error';
} else {
    $status = 'error';
    for ($attempt = 0; $attempt < 2; $attempt++) {
        try {
            $conn = getDBConnection($attempt > 0);
            ensureUserBookmarksTable();

            if ($action === 'save') {
                $stmt = $conn->prepare("INSERT IGNORE INTO user_bookmarks (user_id, article_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $_SESSION['user_id'], $article_id);
                $operation_status = $stmt->execute() ? 'saved' : 'error';
            } else {
                $stmt = $conn->prepare("DELETE FROM user_bookmarks WHERE user_id = ? AND article_id = ?");
                $stmt->bind_param("ii", $_SESSION['user_id'], $article_id);
                $operation_status = $stmt->execute() ? 'removed' : 'error';
            }

            $stmt->close();
            $status = $operation_status;
            break;
        } catch (mysqli_sql_exception $exception) {
            error_log("Bookmark database operation failed: " . $exception->getMessage());
            if ($attempt === 0 && in_array((int) $exception->getCode(), [2006, 2013, 2055], true)) {
                continue;
            }
            break;
        } catch (RuntimeException $exception) {
            error_log("Bookmark database setup failed: " . $exception->getMessage());
            break;
        }
    }
}

$redirect_article_id = is_int($article_id) && isset($article_titles[$article_id]) ? $article_id : 1;
if ($return_to_bookmarks) {
    header("Location: ../profile_activity.php?type=bookmarks&bookmark=" . $status);
    exit();
}

header("Location: ../news.php?id=" . $redirect_article_id . "&bookmark=" . $status);
exit();
