To create a new admin page for the Digital Transformation Office (DTO) website, you can follow the structure and design principles used in the existing index.php file. Below is a sample code for an admin page that includes a navigation menu, a dashboard section, and a form for managing announcements.

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
            <nav class="hidden md:flex gap-6 items-center">
                <a href="index.php" class="hover:text-indigo-200 transition">Home</a>
                <a href="announcements.php" class="hover:text-indigo-200 transition">Announcements</a>
                <a href="news.php" class="hover:text-indigo-200 transition">News</a>
                <a href="calendar.php" class="hover:text-indigo-200 transition">Calendar</a>
                <a href="admin.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Admin</a>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    <i data-lucide="log-out" class="w-4 h-4 inline mr-1"></i>
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard Section -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <!-- Announcements Management -->
        <section class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-2xl font-bold mb-4 text-green-800">Manage Announcements</h3>
            <form action="process_announcement.php" method="POST">
                <div class="mb-4">
                    <label for="announcementTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="announcementTitle" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-amber-300">
                </div>
                <div class="mb-4">
                    <label for="announcementContent" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="announcementContent" name="content" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-amber-300"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700 transition">Add Announcement</button>
            </form>
        </section>

        <!-- Additional Admin Features -->
        <section class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-bold mb-4 text-green-800">Other Admin Features</h3>
            <ul class="list-disc pl-5">
                <li><a href="manage_users.php" class="text-green-600 hover:underline">Manage Users</a></li>
                <li><a href="view_reports.php" class="text-green-600 hover:underline">View Reports</a></li>
                <li><a href="settings.php" class="text-green-600 hover:underline">Settings</a></li>
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

This code creates a simple admin page with a header, a dashboard section for managing announcements, and links to other admin features. You can expand this page further by adding more functionalities as needed, such as user management, report viewing, and settings management.