To create a new admin page for the Digital Transformation Office (DTO) website, you can follow the structure of the existing `index.php` file while adding functionalities specific to an admin interface. Below is a sample code for an `admin.php` page that includes a simple dashboard layout, user management, and content management sections.

Create a new file named `admin.php` in the same directory as your `index.php` file and add the following code:

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
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Management Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">User Management</h3>
                <p class="mb-2">Manage users and their roles.</p>
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">View Users</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add User</button>
            </div>

            <!-- Content Management Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Content Management</h3>
                <p class="mb-2">Manage website content and announcements.</p>
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">View Announcements</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add Announcement</button>
            </div>
        </div>

        <!-- Additional Sections -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-4">Site Settings</h3>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="mb-2">Configure site settings and preferences.</p>
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Edit Settings</button>
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

### Explanation:
1. **Header**: The header includes a logo and navigation links to the home page and a logout button.
2. **Admin Dashboard**: The main section contains a title and two main sections: User Management and Content Management, each with buttons for viewing and adding users or announcements.
3. **Site Settings**: An additional section for site settings is included.
4. **Footer**: A simple footer with copyright information.

### Next Steps:
- Implement the backend logic for user and content management functionalities.
- Ensure proper authentication and authorization for accessing the admin page.
- Style the page further as needed to match the existing website design.