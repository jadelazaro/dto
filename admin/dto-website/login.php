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
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    <i data-lucide="log-out" class="w-4 h-4 inline mr-1"></i>
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Dashboard Section -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>
        
        <section class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-2xl font-semibold mb-4">Manage Announcements</h3>
            <form action="process_announcement.php" method="POST">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Announcement Title</label>
                    <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Enter announcement title">
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Announcement Content</label>
                    <textarea id="content" name="content" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" rows="4" placeholder="Enter announcement content"></textarea>
                </div>
                <button type="submit" class="mt-4 px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700 transition">Add Announcement</button>
            </form>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-semibold mb-4">View Announcements</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Sample Data Row -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Sample Announcement Title</td>
                        <td class="px-6 py-4 whitespace-nowrap">2023-10-01</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other announcements -->
                </tbody>
            </table>
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

This code creates a basic admin page with a header, a dashboard section for managing announcements, and a footer. The form allows the admin to add new announcements, and a table displays existing announcements with options to delete them. You can expand this page further by adding more functionalities as needed, such as editing announcements or managing other content.