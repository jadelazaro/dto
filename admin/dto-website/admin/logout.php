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
                <h1 class="text-4xl font-bold leading-none">DTO Admin</h1>
            </div>
            <nav class="flex gap-6 items-center">
                <a href="index.php" class="hover:text-indigo-200 transition">Home</a>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard -->
    <main class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Manage Announcements -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800">Manage Announcements</h3>
                <form class="mt-4">
                    <input type="text" placeholder="Announcement Title" class="border border-slate-300 rounded p-2 w-full mb-2" required>
                    <textarea placeholder="Announcement Details" class="border border-slate-300 rounded p-2 w-full mb-2" required></textarea>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add Announcement</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-semibold">Existing Announcements</h4>
                    <ul class="list-disc pl-5">
                        <li>Announcement 1</li>
                        <li>Announcement 2</li>
                    </ul>
                </div>
            </div>

            <!-- Manage News -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800">Manage News</h3>
                <form class="mt-4">
                    <input type="text" placeholder="News Title" class="border border-slate-300 rounded p-2 w-full mb-2" required>
                    <textarea placeholder="News Details" class="border border-slate-300 rounded p-2 w-full mb-2" required></textarea>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add News</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-semibold">Existing News</h4>
                    <ul class="list-disc pl-5">
                        <li>News Item 1</li>
                        <li>News Item 2</li>
                    </ul>
                </div>
            </div>

            <!-- Manage Users -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold text-green-800">Manage Users</h3>
                <form class="mt-4">
                    <input type="text" placeholder="User Email" class="border border-slate-300 rounded p-2 w-full mb-2" required>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add User</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-semibold">Existing Users</h4>
                    <ul class="list-disc pl-5">
                        <li>User 1</li>
                        <li>User 2</li>
                    </ul>
                </div>
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