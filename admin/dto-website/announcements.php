<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-4xl font-bold leading-none">DTO Admin</h1>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="index.php" class="hover:text-indigo-200 transition">Home</a>
                <a href="admin.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Admin Dashboard</a>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    <i data-lucide="log-out" class="w-4 h-4 inline mr-1"></i>
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Dashboard Section -->
    <section class="py-12 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 text-center text-green-800">Admin Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Manage Announcements</h3>
                    <p class="text-gray-700 mb-2">Create, edit, or delete announcements for the DTO.</p>
                    <a href="manage_announcements.php" class="text-blue-600 hover:underline">Go to Announcements</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Manage News</h3>
                    <p class="text-gray-700 mb-2">Update the latest news related to digital transformation.</p>
                    <a href="manage_news.php" class="text-blue-600 hover:underline">Go to News</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">User Management</h3>
                    <p class="text-gray-700 mb-2">Manage user accounts and permissions.</p>
                    <a href="manage_users.php" class="text-blue-600 hover:underline">Go to Users</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 text-center">
            <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>