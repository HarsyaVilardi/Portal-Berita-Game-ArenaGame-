<?php
require_once __DIR__ . '/../config/database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function isAdminAuthenticated() {
    if (!isset($_SESSION['admin_user_id']) || !is_numeric($_SESSION['admin_user_id'])) {
        return false;
    }

    $admin_id = (int) $_SESSION['admin_user_id'];
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND role = 'admin'");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $is_admin = $stmt->get_result()->num_rows === 1;
    $stmt->close();

    if (!$is_admin) {
        unset($_SESSION['admin_user_id'], $_SESSION['admin_name'], $_SESSION['admin_csrf_token']);
    }

    return $is_admin;
}

function requireAdmin() {
    if (!isAdminAuthenticated()) {
        header("Location: login.php");
        exit();
    }
}
