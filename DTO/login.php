<?php
/**
 * Login Page - DTO Calendar System
 * Handles user authentication
 */

// Start session
session_start();

// If already logged in, redirect to calendar
if (isset($_SESSION['user_id'])) {
    header('Location: calendar.php');
    exit();
}

// Check for login errors
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config.php';
    require_once 'Auth.php';
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $auth = new Auth($mysqli);
        $result = $auth->login($username, $password);
        
        if ($result['success']) {
            header('Location: calendar.php');
            exit();
        } else {
            $error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .fade-in { animation: fadeIn 0.6s ease; }
        .slide-in { animation: slideIn 0.6s ease; }
        
        body {
            background: linear-gradient(135deg, #78350f 0%, #7c2d12 50%, #5a1e0a 100%);
            min-height: 100vh;
        }
        
        .login-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="text-slate-900">
    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md fade-in">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <img src="DTO outline (1).png" alt="DTO Logo" class="w-24 h-24 drop-shadow-lg slide-in">
                </div>
                <h1 class="text-4xl font-bold text-amber-900 mb-2">DTO</h1>
                <p class="text-slate-600">Digital Transformation Office</p>
                <p class="text-sm text-slate-500 mt-1">Admin Login Portal</p>
            </div>
            
            <!-- Login Form -->
            <div class="login-container rounded-2xl shadow-2xl p-8 md:p-10">
                <!-- Error Message -->
                <?php if ($error): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>
                
                <!-- Welcome Message -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                    <p class="text-slate-600 text-sm">Sign in to your admin account to manage events and content</p>
                </div>
                
                <!-- Form -->
                <form method="POST" class="space-y-5">
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
                            <span class="flex items-center gap-2">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                Username
                            </span>
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required 
                            autocomplete="username"
                            placeholder="Enter your username"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition bg-slate-50 hover:bg-white"
                        >
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            <span class="flex items-center gap-2">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                                Password
                            </span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition bg-slate-50 hover:bg-white"
                        >
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full mt-6 py-3 px-4 bg-gradient-to-r from-amber-800 to-red-900 text-white font-semibold rounded-lg hover:shadow-lg hover:scale-105 transition transform duration-200 flex items-center justify-center gap-2"
                    >
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        Sign In
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-slate-500">Or continue as</span>
                    </div>
                </div>
                
                <!-- Guest Access -->
                <a href="calendar.php" class="w-full py-3 px-4 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition flex items-center justify-center gap-2">
                    <i data-lucide="eye" class="w-5 h-5"></i>
                    View as Guest
                </a>
            </div>
            
            <!-- Footer Info -->
            <div class="mt-8 text-center">
                <p class="text-sm text-slate-300 mb-4">
                    <i data-lucide="shield" class="w-4 h-4 inline mr-1"></i>
                    Default Credentials (Change in production)
                </p>
                <div class="bg-amber-900/20 border border-amber-900/30 rounded-lg p-4 text-sm text-amber-50">
                    <p><strong>Username:</strong> admin</p>
                    <p><strong>Password:</strong> admin123</p>
                </div>
            </div>
            
            <!-- Links -->
            <div class="mt-6 text-center text-sm text-slate-400">
                <a href="index.php" class="hover:text-amber-400 transition flex items-center justify-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Return to Home
                </a>
            </div>
        </div>
    </div>
    
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
