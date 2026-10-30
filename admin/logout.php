<?php
require_once __DIR__ . '/../includes/admin_auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$csrf_token = $_POST['csrf_token'] ?? '';
if (
    !is_string($csrf_token)
    || !isset($_SESSION['admin_csrf_token'])
    || !hash_equals($_SESSION['admin_csrf_token'], $csrf_token)
) {
    http_response_code(403);
    exit('Permintaan logout tidak valid.');
}

unset($_SESSION['admin_user_id'], $_SESSION['admin_name'], $_SESSION['admin_csrf_token']);
session_regenerate_id(true);

header("Location: login.php?logout=success");
exit();
