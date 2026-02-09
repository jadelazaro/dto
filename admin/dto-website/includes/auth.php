<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-4xl font-bold leading-none">Admin Dashboard</h1>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="index.php" class="hover:text-indigo-200 transition">Home</a>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Welcome to the Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Manage Announcements -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800 mb-2">Manage Announcements</h3>
                <form action="manage_announcements.php" method="POST">
                    <input type="text" name="announcement" placeholder="New Announcement" class="border rounded p-2 w-full mb-2" required>
                    <button type="submit" class="w-full bg-green-800 text-white rounded p-2 hover:bg-green-700">Add Announcement</button>
                </form>
                <a href="view_announcements.php" class="text-blue-600 hover:underline">View All Announcements</a>
            </div>

            <!-- Manage News -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800 mb-2">Manage News</h3>
                <form action="manage_news.php" method="POST">
                    <input type="text" name="news_title" placeholder="News Title" class="border rounded p-2 w-full mb-2" required>
                    <textarea name="news_content" placeholder="News Content" class="border rounded p-2 w-full mb-2" required></textarea>
                    <button type="submit" class="w-full bg-green-800 text-white rounded p-2 hover:bg-green-700">Add News</button>
                </form>
                <a href="view_news.php" class="text-blue-600 hover:underline">View All News</a>
            </div>

            <!-- Manage Users -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800 mb-2">Manage Users</h3>
                <form action="manage_users.php" method="POST">
                    <input type="text" name="username" placeholder="Username" class="border rounded p-2 w-full mb-2" required>
                    <input type="email" name="email" placeholder="Email" class="border rounded p-2 w-full mb-2" required>
                    <button type="submit" class="w-full bg-green-800 text-white rounded p-2 hover:bg-green-700">Add User</button>
                </form>
                <a href="view_users.php" class="text-blue-600 hover:underline">View All Users</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 text-center">
            <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>