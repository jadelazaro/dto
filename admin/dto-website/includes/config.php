To create a new admin page for the Digital Transformation Office (DTO) website, you can follow the structure of the existing index.php file while adding specific functionalities for admin tasks. Below is a sample code for an admin page that includes a simple dashboard layout with sections for managing announcements, news, and user accounts.

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
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-3xl font-bold mb-6 text-green-800">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Announcements Section -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold mb-4">Manage Announcements</h3>
                <form action="manage_announcements.php" method="POST">
                    <input type="text" name="announcement" placeholder="New Announcement" class="border rounded p-2 w-full mb-2" required>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add Announcement</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-bold">Current Announcements:</h4>
                    <ul class="list-disc pl-5">
                        <!-- Fetch and display announcements from the database -->
                    </ul>
                </div>
            </div>

            <!-- News Section -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold mb-4">Manage News</h3>
                <form action="manage_news.php" method="POST">
                    <input type="text" name="news_title" placeholder="News Title" class="border rounded p-2 w-full mb-2" required>
                    <textarea name="news_content" placeholder="News Content" class="border rounded p-2 w-full mb-2" required></textarea>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add News</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-bold">Current News:</h4>
                    <ul class="list-disc pl-5">
                        <!-- Fetch and display news from the database -->
                    </ul>
                </div>
            </div>

            <!-- User Accounts Section -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-xl font-semibold mb-4">Manage User Accounts</h3>
                <form action="manage_users.php" method="POST">
                    <input type="text" name="username" placeholder="Username" class="border rounded p-2 w-full mb-2" required>
                    <input type="email" name="email" placeholder="Email" class="border rounded p-2 w-full mb-2" required>
                    <button type="submit" class="bg-green-800 text-white rounded px-4 py-2">Add User</button>
                </form>
                <div class="mt-4">
                    <h4 class="font-bold">Current Users:</h4>
                    <ul class="list-disc pl-5">
                        <!-- Fetch and display user accounts from the database -->
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

### Explanation:
1. **Header**: The header includes a logo and navigation links to the home page and a logout option.
2. **Admin Dashboard**: The main section contains three cards for managing announcements, news, and user accounts. Each card has a form to add new entries and a section to display current entries.
3. **Footer**: A simple footer with copyright information.

### Next Steps:
- Implement the backend logic for handling form submissions in `manage_announcements.php`, `manage_news.php`, and `manage_users.php`.
- Fetch and display current announcements, news, and users from the database in the respective sections.
- Ensure proper authentication and authorization for accessing the admin page to prevent unauthorized access.