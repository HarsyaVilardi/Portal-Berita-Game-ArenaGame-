<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$page_title = "Register";

$success_message = '';
$error_message = '';

if (isset($_GET['error']) && isset($_GET['message'])) {
    $error_message = htmlspecialchars($_GET['message']);
}

include 'includes/header.php';
?>



<?php

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

$page_title = "Register";

$success_message = '';
$error_message = '';

// Menangkap kiriman data form jika tombol register diklik (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Cek jika password tidak cocok
    if ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak cocok";
    }
    
    if (empty($errors)) {
        // Success - In real application, you would insert to database here
        $success_message = "Selamat! Akun Anda berhasil dibuat dengan username: <strong>$username</strong>. Silakan login untuk melanjutkan.";
        
        // Clear form
        $name = '';
        $email = '';
        $username = '';
        $password = '';
        $confirm_password = '';
    } else {
        $error_message = implode("<br>", $errors);
    }
}

include 'includes/header.php';
?>


<!-- Register Section -->
<section class="min-h-screen flex items-center justify-center py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <!-- Register Card -->
            <div class="bg-dark rounded-lg p-8 shadow-2xl">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center font-bold text-xl">
                            AG
                        </div>
                        <span class="text-2xl font-bold">CriticalFrame</span>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Buat Akun Baru</h1>
                    <p class="text-gray-400">Bergabunglah dengan komunitas esports terbesar</p>
                </div>
                
                <?php if ($success_message): ?>
                    <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6 text-center">
                        <?php echo $success_message; ?>
                        <div class="mt-3">
                            <a href="login.php" class="text-green-400 hover:underline font-semibold">Login Sekarang →</a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form id="register-form" method="POST" action="processes/handle_register.php" class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" required minlength="3"
                                   class="w-full pl-10 pr-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white"
                                   placeholder="John Doe">
                        </div>
                    </div>
                    
                    <div>
                        <label for="username" class="block text-sm font-medium mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="username" name="username" required minlength="4"
                                   class="w-full pl-10 pr-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white"
                                   placeholder="johndoe123">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Hanya huruf, angka, dan underscore</p>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" required
                                   class="w-full pl-10 pr-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white"
                                   placeholder="john@email.com">
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required minlength="6"
                                   class="w-full pl-10 pr-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white"
                                   placeholder="••••••••">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
                    </div>
                    
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input type="password" id="confirm_password" name="confirm_password" required minlength="6"
                                   class="w-full pl-10 pr-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white"
                                   placeholder="••••••••">
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required class="w-4 h-4 mt-1 text-primary bg-darker border-gray-700 rounded focus:ring-primary focus:ring-2">
                        <label for="terms" class="ml-2 text-sm text-gray-400">
                            Saya setuju dengan <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary hover:bg-red-600 text-white py-3 rounded-lg font-semibold transition-all btn-primary">
                        Daftar Sekarang
                    </button>
                    
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-dark text-gray-400">Atau daftar dengan</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="flex items-center justify-center px-4 py-3 border border-gray-700 rounded-lg hover:bg-darker transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span class="text-sm">Google</span>
                        </button>
                        <button type="button" class="flex items-center justify-center px-4 py-3 border border-gray-700 rounded-lg hover:bg-darker transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-sm">Facebook</span>
                        </button>
                    </div>
                </form>
                
                <p class="text-center mt-6 text-gray-400">
                    Sudah punya akun? 
                    <a href="login.php" class="text-primary hover:underline font-semibold">Login di sini</a>
                </p>
            </div>
            
            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="index.php" class="text-gray-400 hover:text-primary transition-colors text-sm">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
