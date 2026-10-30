<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$csrf_token = $_POST['csrf_token'] ?? '';
if (
    !is_string($csrf_token)
    || !isset($_SESSION['logout_token'])
    || !is_string($_SESSION['logout_token'])
    || !hash_equals($_SESSION['logout_token'], $csrf_token)
) {
    header("Location: ../index.php?logout=error");
    exit();
}

session_unset();
session_destroy();

header("Location: ../index.php?logout=success");
exit();
?>
