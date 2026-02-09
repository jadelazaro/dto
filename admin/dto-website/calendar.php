To create a new admin page for the Digital Transformation Office (DTO) website, you can follow the structure and design principles used in the existing index.php file. Below is a simple example of what the admin page might look like, including sections for managing announcements, news, and user accounts.

Create a new file named `admin.php` in the same directory as your `index.php` file and add the following code:

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
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <!-- Announcements Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold mb-4">Manage Announcements</h3>
            <form class="mb-4">
                <input type="text" placeholder="Announcement Title" class="border border-slate-300 rounded p-2 w-full mb-2">
                <textarea placeholder="Announcement Details" class="border border-slate-300 rounded p-2 w-full mb-2"></textarea>
                <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add Announcement</button>
            </form>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold mb-2">Current Announcements</h4>
                <ul class="space-y-2">
                    <li class="border-b border-slate-200 pb-2">Announcement 1 <button class="text-red-600">Delete</button></li>
                    <li class="border-b border-slate-200 pb-2">Announcement 2 <button class="text-red-600">Delete</button></li>
                </ul>
            </div>
        </section>

        <!-- News Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold mb-4">Manage News</h3>
            <form class="mb-4">
                <input type="text" placeholder="News Title" class="border border-slate-300 rounded p-2 w-full mb-2">
                <textarea placeholder="News Details" class="border border-slate-300 rounded p-2 w-full mb-2"></textarea>
                <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add News</button>
            </form>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold mb-2">Current News</h4>
                <ul class="space-y-2">
                    <li class="border-b border-slate-200 pb-2">News Item 1 <button class="text-red-600">Delete</button></li>
                    <li class="border-b border-slate-200 pb-2">News Item 2 <button class="text-red-600">Delete</button></li>
                </ul>
            </div>
        </section>

        <!-- User Management Section -->
        <section>
            <h3 class="text-2xl font-semibold mb-4">User Management</h3>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold mb-2">Registered Users</h4>
                <ul class="space-y-2">
                    <li class="border-b border-slate-200 pb-2">User 1 <button class="text-red-600">Delete</button></li>
                    <li class="border-b border-slate-200 pb-2">User 2 <button class="text-red-600">Delete</button></li>
                </ul>
            </div>
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

This admin page includes sections for managing announcements, news, and user accounts. You can expand the functionality by adding backend logic to handle form submissions, data retrieval, and user management. Make sure to implement proper authentication and authorization to secure the admin page.