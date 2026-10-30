<?php
require_once __DIR__ . '/../includes/admin_auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

$csrf_token = $_POST['csrf_token'] ?? '';
if (
    !is_string($csrf_token)
    || !isset($_SESSION['admin_login_csrf_token'])
    || !hash_equals($_SESSION['admin_login_csrf_token'], $csrf_token)
) {
    header("Location: login.php?error=1");
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!is_string($email) || !is_string($password)) {
    header("Location: login.php?error=1");
    exit();
}

$email = trim($email);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    header("Location: login.php?error=1");
    exit();
}

$conn = getDBConnection();
$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ? AND role = 'admin'");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

if (!$admin || !password_verify($password, $admin['password'])) {
    header("Location: login.php?error=1");
    exit();
}

session_regenerate_id(true);
unset($_SESSION['admin_login_csrf_token']);
$_SESSION['admin_user_id'] = (int) $admin['id'];
$_SESSION['admin_name'] = $admin['name'];
$_SESSION['admin_csrf_token'] = bin2hex(random_bytes(32));

header("Location: index.php");
exit();
