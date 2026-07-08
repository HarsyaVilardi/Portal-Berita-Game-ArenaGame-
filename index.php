<?php
$page_title = "Home";
include 'includes/header.php';

if (isset($_GET['login']) && $_GET['login'] == 'success' && isset($_SESSION['user_id'])) {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            showNotification("Selamat datang kembali, ' . htmlspecialchars($_SESSION['name']) . '!", "success");
        });
    </script>';
}

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            showNotification("Anda berhasil logout. Sampai jumpa lagi!", "success");
        });
    </script>';
}
?>

<section class="relative py-20 hero-gradient overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-shadow fade-in">
                Selamat Datang di <span class="gradient-text">CriticalFrame</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8 fade-in">
                Portal Berita Esports & Gaming Terdepan di Indonesia
            </p>
            <div class="flex flex-wrap justify-center gap-4 fade-in">
                <a href="#latest" class="bg-primary hover:bg-red-600 text-white px-8 py-3 rounded-lg font-semibold transition-all btn-primary">
                    Berita Terbaru
                </a>
                <a href="register.php" class="bg-transparent border-2 border-primary hover:bg-primary text-white px-8 py-3 rounded-lg font-semibold transition-all">
                    Gabung Sekarang
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary opacity-10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary opacity-10 rounded-full blur-3xl"></div>
</section>

<!-- Featured News Section -->
<section id="latest" class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Berita <span class="text-primary">Terbaru</span></h2>
            <a href="#" class="text-primary hover:underline text-sm font-semibold uppercase">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Featured Card 1 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/lignas.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Turnamen</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            Puncak Liga Esports Nasional Pelajar 2025, SMK Harapan Bangsa Raih Gelar Juara
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
            
            <!-- Featured Card 2 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/vct.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Turnamen</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            Siapa Pengganti Talon di VCT Pacific? Ini Bocoran, Fall Bottom, dan Suframi Jadi Favorit
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
            
            <!-- Featured Card 3 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/tga.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Update</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            The Game Awards 2025: Venue, Jadwal & Sistem Juri – Semua yang Perlu Kamu Tahu
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
            
            <!-- Featured Card 4 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/apac.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Turnamen</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            RRQ, BOOM, Bigetron, dan Vangis Wakili Indonesia di APAC Predator League 2025
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
            
            <!-- Featured Card 5 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/gmys.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Update</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            Gunayusi Tinggalkan T1: Perpindahan Besar yang Guncang Offseason LCK 2025
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
            
            <!-- Featured Card 6 -->
            <div class="news-card bg-dark rounded-lg overflow-hidden group cursor-pointer">
                <div class="relative h-48 bg-gray-800 overflow-hidden">
                    <img src="assets/images/hok.jpg" alt="Esports" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="badge">Campus</span>
                    </div>
                    <div class="card-overlay"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-primary transition-colors">
                            Inilah Pemenang Campus Ambassador di Honor of Kings Invitational 2025
                        </h3>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-400 text-sm">24 Maret 2025 | Turnamen</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Esports Section -->
<section id="esports" class="py-16 bg-dark">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold"><span class="text-primary">Esports</span> Highlight</h2>
            <a href="#" class="text-primary hover:underline text-sm font-semibold uppercase">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Esports Card 1 -->
            <div class="bg-darker rounded-lg overflow-hidden group cursor-pointer news-card">
                <div class="relative h-40 bg-gray-800">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-transparent"></div>
                    <div class="card-overlay"></div>
                </div>
                <div class="p-5">
                    <span class="badge mb-3">Mobile Legends</span>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        MPL ID Season 14: Jadwal, Tim, dan Format Turnamen
                    </h3>
                    <p class="text-gray-400 text-sm">18 Maret 2025</p>
                </div>
            </div>
            
            <!-- Esports Card 2 -->
            <div class="bg-darker rounded-lg overflow-hidden group cursor-pointer news-card">
                <div class="relative h-40 bg-gray-800">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent"></div>
                    <div class="card-overlay"></div>
                </div>
                <div class="p-5">
                    <span class="badge mb-3">Valorant</span>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        VCT Pacific 2025: RRQ Hoshi Lolos ke Playoff
                    </h3>
                    <p class="text-gray-400 text-sm">17 Maret 2025</p>
                </div>
            </div>
            
            <!-- Esports Card 3 -->
            <div class="bg-darker rounded-lg overflow-hidden group cursor-pointer news-card">
                <div class="relative h-40 bg-gray-800">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-transparent"></div>
                    <div class="card-overlay"></div>
                </div>
                <div class="p-5">
                    <span class="badge mb-3">Dota 2</span>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        BOOM Esports Raih Juara di DPC SEA Tour 3
                    </h3>
                    <p class="text-gray-400 text-sm">16 Maret 2025</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Games Section -->
<section id="games" class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Berita <span class="text-primary">Games</span></h2>
            <a href="#" class="text-primary hover:underline text-sm font-semibold uppercase">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Game Card 1 -->
            <div class="bg-dark rounded-lg overflow-hidden flex group cursor-pointer news-card">
                <div class="w-1/3 bg-gray-800 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent"></div>
                </div>
                <div class="w-2/3 p-5">
                    <span class="badge mb-2">Review</span>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        Review GTA VI: Game Open World Terbaik 2025?
                    </h3>
                    <p class="text-gray-400 text-sm mb-2">
                        Rockstar Games kembali dengan mahakarya terbarunya...
                    </p>
                    <p class="text-gray-500 text-xs">15 Maret 2025</p>
                </div>
            </div>
            
            <!-- Game Card 2 -->
            <div class="bg-dark rounded-lg overflow-hidden flex group cursor-pointer news-card">
                <div class="w-1/3 bg-gray-800 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent"></div>
                </div>
                <div class="w-2/3 p-5">
                    <span class="badge mb-2">Update</span>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        Update Terbaru Genshin Impact 5.0 Hadir dengan Region Baru
                    </h3>
                    <p class="text-gray-400 text-sm mb-2">
                        HoYoverse mengumumkan ekspansi besar untuk Genshin Impact...
                    </p>
                    <p class="text-gray-500 text-xs">14 Maret 2025</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary to-red-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Bergabung dengan Komunitas Kami</h2>
        <p class="text-xl mb-8 opacity-90">Dapatkan berita esports terbaru langsung di email Anda</p>
        <div class="max-w-md mx-auto flex gap-4">
            <input type="email" placeholder="Email Anda" class="flex-1 px-6 py-3 rounded-lg text-gray-900 focus:outline-none">
            <button class="bg-darker hover:bg-black text-white px-8 py-3 rounded-lg font-semibold transition-all">
                Subscribe
            </button>
        </div>
    </div>
</section>

<!-- Scroll to Top Button -->
<button id="scroll-to-top" onclick="scrollToTop()" class="hidden fixed bottom-8 right-8 bg-primary hover:bg-red-600 text-white p-4 rounded-full shadow-lg transition-all z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>

<?php include 'includes/footer.php'; ?>
