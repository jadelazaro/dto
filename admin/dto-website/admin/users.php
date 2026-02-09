<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                Logout
            </a>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Admin Menu</h2>
            <ul class="space-y-2">
                <li><a href="#announcements" class="block p-2 hover:bg-gray-200 rounded">Manage Announcements</a></li>
                <li><a href="#news" class="block p-2 hover:bg-gray-200 rounded">Manage News</a></li>
                <li><a href="#users" class="block p-2 hover:bg-gray-200 rounded">Manage Users</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <section id="announcements" class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Manage Announcements</h2>
                <form action="add_announcement.php" method="POST" class="mb-4">
                    <input type="text" name="announcement" placeholder="New Announcement" class="border p-2 w-full" required>
                    <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add Announcement</button>
                </form>
                <div class="bg-white shadow-md rounded p-4">
                    <h3 class="font-bold">Current Announcements</h3>
                    <ul class="space-y-2">
                        <!-- Example announcements -->
                        <li>Announcement 1 <a href="edit_announcement.php?id=1" class="text-blue-500">Edit</a></li>
                        <li>Announcement 2 <a href="edit_announcement.php?id=2" class="text-blue-500">Edit</a></li>
                    </ul>
                </div>
            </section>

            <section id="news" class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Manage News</h2>
                <form action="add_news.php" method="POST" class="mb-4">
                    <input type="text" name="news_title" placeholder="News Title" class="border p-2 w-full" required>
                    <textarea name="news_content" placeholder="News Content" class="border p-2 w-full" required></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add News</button>
                </form>
                <div class="bg-white shadow-md rounded p-4">
                    <h3 class="font-bold">Current News</h3>
                    <ul class="space-y-2">
                        <!-- Example news -->
                        <li>News Title 1 <a href="edit_news.php?id=1" class="text-blue-500">Edit</a></li>
                        <li>News Title 2 <a href="edit_news.php?id=2" class="text-blue-500">Edit</a></li>
                    </ul>
                </div>
            </section>

            <section id="users">
                <h2 class="text-2xl font-bold mb-4">Manage Users</h2>
                <div class="bg-white shadow-md rounded p-4">
                    <h3 class="font-bold">User List</h3>
                    <ul class="space-y-2">
                        <!-- Example users -->
                        <li>User 1 <a href="edit_user.php?id=1" class="text-blue-500">Edit</a></li>
                        <li>User 2 <a href="edit_user.php?id=2" class="text-blue-500">Edit</a></li>
                    </ul>
                </div>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 text-center">
            <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>