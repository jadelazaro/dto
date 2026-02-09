<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Digital Transformation Office</title>
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
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    <i data-lucide="log-out" class="w-4 h-4 inline mr-1"></i>
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard -->
    <main class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <!-- Announcements Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold text-green-800 mb-4">Manage Announcements</h3>
            <form class="mb-4">
                <input type="text" placeholder="New Announcement" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700">Add Announcement</button>
            </form>
            <ul class="list-disc pl-5">
                <li>Announcement 1 <button class="text-red-600 hover:underline">Delete</button></li>
                <li>Announcement 2 <button class="text-red-600 hover:underline">Delete</button></li>
            </ul>
        </section>

        <!-- News Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold text-green-800 mb-4">Manage News</h3>
            <form class="mb-4">
                <input type="text" placeholder="New News Item" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700">Add News</button>
            </form>
            <ul class="list-disc pl-5">
                <li>News Item 1 <button class="text-red-600 hover:underline">Delete</button></li>
                <li>News Item 2 <button class="text-red-600 hover:underline">Delete</button></li>
            </ul>
        </section>

        <!-- User Accounts Section -->
        <section>
            <h3 class="text-2xl font-semibold text-green-800 mb-4">Manage User Accounts</h3>
            <form class="mb-4">
                <input type="text" placeholder="New User Email" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700">Add User</button>
            </form>
            <ul class="list-disc pl-5">
                <li>User 1 <button class="text-red-600 hover:underline">Delete</button></li>
                <li>User 2 <button class="text-red-600 hover:underline">Delete</button></li>
            </ul>
        </section>
    </main>

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