<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$page_title = "Profile Saya";
include 'includes/header.php';

$success_message = '';
$error_message = '';

if (isset($_GET['updated']) && $_GET['updated'] == '1') {
    $success_message = "Profile berhasil diupdate!";
}
?>

<section class="min-h-screen py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-dark rounded-lg shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-red-600 h-32"></div>
                
                <div class="px-8 pb-8">
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 mb-8">
                        <div class="flex items-end space-x-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-primary to-red-600 rounded-full flex items-center justify-center text-4xl font-bold border-4 border-dark shadow-xl">
                                <?php 
                                $initials = '';
                                $name_parts = explode(' ', $_SESSION['name']);
                                foreach ($name_parts as $part) {
                                    $initials .= strtoupper(substr($part, 0, 1));
                                }
                                echo substr($initials, 0, 2);
                                ?>
                            </div>
                            <div class="mb-4">
                                <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($_SESSION['name']); ?></h1>
                                <p class="text-gray-400">@<?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3 mt-4 md:mt-0">
                            <button onclick="toggleEditMode()" class="bg-primary hover:bg-red-600 text-white px-6 py-2 rounded-lg font-semibold transition-all">
                                Edit Profile
                            </button>
                            <a href="processes/handle_logout.php" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition-all">
                                Logout
                            </a>
                        </div>
                    </div>
                    
                    <?php if ($success_message): ?>
                        <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error_message): ?>
                        <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div id="profile-view">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-bold mb-6">Informasi <span class="text-primary">Personal</span></h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-gray-400">Nama Lengkap</label>
                                        <p class="text-lg font-semibold"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm text-gray-400">Username</label>
                                        <p class="text-lg font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm text-gray-400">Email</label>
                                        <p class="text-lg font-semibold"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm text-gray-400">Member Since</label>
                                        <p class="text-lg font-semibold"><?php echo isset($_SESSION['created_at']) ? date('d F Y', strtotime($_SESSION['created_at'])) : 'N/A'; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-bold mb-6">Statistik <span class="text-primary">Aktivitas</span></h3>
                                
                                <div class="space-y-4">
                                    <div class="bg-darker rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-400 text-sm">Artikel Dibaca</p>
                                                <p class="text-2xl font-bold text-primary">0</p>
                                            </div>
                                            <svg class="w-10 h-10 text-primary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-darker rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-400 text-sm">Komentar</p>
                                                <p class="text-2xl font-bold text-primary">0</p>
                                            </div>
                                            <svg class="w-10 h-10 text-primary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-darker rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-gray-400 text-sm">Bookmark</p>
                                                <p class="text-2xl font-bold text-primary">0</p>
                                            </div>
                                            <svg class="w-10 h-10 text-primary opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="profile-edit" class="hidden">
                        <h3 class="text-xl font-bold mb-6">Edit <span class="text-primary">Profile</span></h3>
                        
                        <form action="processes/handle_update_profile.php" method="POST" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium mb-2">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" required
                                           class="w-full px-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                                </div>
                                
                                <div>
                                    <label for="username" class="block text-sm font-medium mb-2">Username</label>
                                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required
                                           class="w-full px-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required
                                           class="w-full px-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                                </div>
                                
                                <div>
                                    <label for="new_password" class="block text-sm font-medium mb-2">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" id="new_password" name="new_password"
                                           class="w-full px-4 py-3 bg-darker border border-gray-700 rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                                </div>
                            </div>
                            
                            <div class="flex space-x-4">
                                <button type="submit" class="bg-primary hover:bg-red-600 text-white px-8 py-3 rounded-lg font-semibold transition-all">
                                    Simpan Perubahan
                                </button>
                                <button type="button" onclick="toggleEditMode()" class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition-all">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 grid md:grid-cols-3 gap-6">
                <div class="bg-dark rounded-lg p-6 text-center">
                    <svg class="w-12 h-12 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <h3 class="font-bold mb-2">Level: Newbie</h3>
                    <p class="text-gray-400 text-sm">Mulai perjalanan esports Anda!</p>
                </div>
                
                <div class="bg-dark rounded-lg p-6 text-center">
                    <svg class="w-12 h-12 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <h3 class="font-bold mb-2">Badge: 0</h3>
                    <p class="text-gray-400 text-sm">Raih badge dengan aktivitas!</p>
                </div>
                
                <div class="bg-dark rounded-lg p-6 text-center">
                    <svg class="w-12 h-12 text-primary mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="font-bold mb-2">Points: 0</h3>
                    <p class="text-gray-400 text-sm">Kumpulkan poin rewards!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleEditMode() {
    const viewSection = document.getElementById('profile-view');
    const editSection = document.getElementById('profile-edit');
    
    if (viewSection.classList.contains('hidden')) {
        viewSection.classList.remove('hidden');
        editSection.classList.add('hidden');
    } else {
        viewSection.classList.add('hidden');
        editSection.classList.remove('hidden');
    }
}
</script>

<?php include 'includes/footer.php'; ?>
