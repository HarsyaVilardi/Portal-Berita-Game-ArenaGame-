<?php
require_once __DIR__ . '/../includes/admin_auth.php';

if (isAdminAuthenticated()) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['admin_login_csrf_token'])) {
    $_SESSION['admin_login_csrf_token'] = bin2hex(random_bytes(32));
}

$error_message = isset($_GET['error']) ? 'Email atau password salah, atau akun ini bukan admin.' : '';
$success_message = isset($_GET['logout']) ? 'Anda berhasil keluar dari dashboard admin.' : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ArenaGame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff4655',
                        dark: '#0a0e27',
                        darker: '#060814',
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-darker text-white flex items-center justify-center px-4">
    <main class="w-full max-w-md rounded-lg bg-dark p-8 shadow-2xl">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-primary text-xl font-bold">AG</div>
            <h1 class="text-3xl font-bold">Login Admin</h1>
            <p class="mt-2 text-gray-400">Masuk dengan akun yang memiliki akses admin.</p>
        </div>

        <?php if ($error_message !== ''): ?>
            <p class="mb-6 rounded-lg border border-red-500 bg-red-500/20 px-4 py-3 text-red-300" role="alert">
                <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>
        <?php if ($success_message !== ''): ?>
            <p class="mb-6 rounded-lg border border-green-500 bg-green-500/20 px-4 py-3 text-green-300" role="status">
                <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="process_login.php" class="space-y-5">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['admin_login_csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <div>
                <label for="email" class="mb-2 block text-sm font-medium">Email admin</label>
                <input type="email" id="email" name="email" required autocomplete="username"
                       class="w-full rounded-lg border border-gray-700 bg-darker px-4 py-3 text-white focus:border-primary focus:outline-none"
                       placeholder="admin@email.com">
            </div>
            <div>
                <label for="password" class="mb-2 block text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                       class="w-full rounded-lg border border-gray-700 bg-darker px-4 py-3 text-white focus:border-primary focus:outline-none"
                       placeholder="Password admin">
            </div>
            <button type="submit" class="w-full rounded-lg bg-primary py-3 font-semibold transition-colors hover:bg-red-600">
                Masuk ke Dashboard
            </button>
        </form>

        <p class="mt-6 text-center">
            <a href="../index.php" class="text-sm text-gray-400 transition-colors hover:text-primary">Kembali ke beranda</a>
        </p>
    </main>
</body>
</html>
