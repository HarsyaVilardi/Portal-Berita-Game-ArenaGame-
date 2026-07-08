<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - CriticalFrame.com' : 'CriticalFrame.com - Portal Esports Indonesia'; ?></title>
    
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-darker text-white">
    <?php if (!isset($_SESSION)) { session_start(); } ?>
    
    <nav class="fixed w-full top-0 z-50 bg-dark/95 backdrop-blur-sm border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center font-bold text-xl">
                            CF
                        </div>
                        <span class="text-xl font-bold hidden sm:block">CriticalFrame</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-primary hover:text-primary transition-colors uppercase text-sm font-semibold">Home</a>
                    <a href="index.php#latest" class="hover:text-primary transition-colors uppercase text-sm font-medium">Latest</a>
                    <a href="index.php#esports" class="hover:text-primary transition-colors uppercase text-sm font-medium">Esports</a>
                    <a href="index.php#games" class="hover:text-primary transition-colors uppercase text-sm font-medium">Games</a>
                    <a href="about.php" class="hover:text-primary transition-colors uppercase text-sm font-medium">About</a>
                    <a href="contact.php" class="hover:text-primary transition-colors uppercase text-sm font-medium">Contact</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="flex items-center space-x-3">
                            <a href="profile.php" class="flex items-center space-x-2 hover:text-primary transition-colors">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-xs font-bold">
                                    <?php 
                                    $initials = '';
                                    $name_parts = explode(' ', $_SESSION['name']);
                                    foreach ($name_parts as $part) {
                                        $initials .= strtoupper(substr($part, 0, 1));
                                    }
                                    echo substr($initials, 0, 2);
                                    ?>
                                </div>
                                <span class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </a>
                            <a href="processes/handle_logout.php" class="text-sm hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="text-sm hover:text-primary transition-colors font-medium">Login</a>
                        <a href="register.php" class="bg-primary hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
                
                <button id="mobile-menu-button" class="md:hidden text-white hover:text-primary transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="hidden md:hidden bg-dark border-t border-gray-800">
            <div class="container mx-auto px-4 py-4 space-y-3">
                <a href="index.php" class="block text-primary hover:text-primary transition-colors uppercase text-sm font-semibold">Home</a>
                <a href="index.php#latest" class="block hover:text-primary transition-colors uppercase text-sm">Latest</a>
                <a href="index.php#esports" class="block hover:text-primary transition-colors uppercase text-sm">Esports</a>
                <a href="index.php#games" class="block hover:text-primary transition-colors uppercase text-sm">Games</a>
                <a href="about.php" class="block hover:text-primary transition-colors uppercase text-sm">About</a>
                <a href="contact.php" class="block hover:text-primary transition-colors uppercase text-sm">Contact</a>
                <div class="pt-3 border-t border-gray-800">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-xs font-bold">
                                <?php 
                                $initials = '';
                                $name_parts = explode(' ', $_SESSION['name']);
                                foreach ($name_parts as $part) {
                                    $initials .= strtoupper(substr($part, 0, 1));
                                }
                                echo substr($initials, 0, 2);
                                ?>
                            </div>
                            <span class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </div>
                        <div class="flex space-x-4">
                            <a href="profile.php" class="text-sm hover:text-primary transition-colors">Profile</a>
                            <a href="processes/handle_logout.php" class="text-sm hover:text-primary transition-colors">Logout</a>
                        </div>
                    <?php else: ?>
                        <div class="flex space-x-4">
                            <a href="login.php" class="text-sm hover:text-primary transition-colors">Login</a>
                            <a href="register.php" class="text-sm hover:text-primary transition-colors">Register</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    
    <div class="h-16"></div>
