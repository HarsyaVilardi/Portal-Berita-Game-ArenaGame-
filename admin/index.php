<?php
require_once __DIR__ . '/../includes/admin_auth.php';
requireAdmin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ArenaGame</title>
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
<body class="min-h-screen bg-darker text-white">
    <header class="border-b border-gray-800 bg-dark">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
            <a href="../index.php" class="text-lg font-bold">ArenaGame <span class="text-primary">Admin</span></a>
            <form method="POST" action="logout.php">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['admin_csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="rounded-lg border border-gray-700 px-4 py-2 text-sm hover:border-primary hover:text-primary">
                    Logout
                </button>
            </form>
        </div>
    </header>
    <main class="mx-auto max-w-5xl px-4 py-12">
        <section class="rounded-lg bg-dark p-8 shadow-xl">
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            <p class="mt-3 text-gray-300">
                Selamat datang, <?php echo htmlspecialchars($_SESSION['admin_name'], ENT_QUOTES, 'UTF-8'); ?>.
            </p>
            <p class="mt-2 text-sm text-gray-400">Halaman ini hanya dapat diakses oleh akun dengan peran admin.</p>
        </section>
    </main>
</body>
</html>
