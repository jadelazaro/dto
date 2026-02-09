To create a new admin page for the Digital Transformation Office (DTO) website, you can follow the structure of the existing index.php file while adding specific functionalities for admin tasks. Below is a simple example of what the admin page could look like, including sections for managing announcements, news, and user accounts.

Create a new file named `admin.php` in the same directory as your `index.php` file and add the following code:

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
    <main class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold mb-4">Admin Dashboard</h2>

        <!-- Announcements Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold mb-2">Manage Announcements</h3>
            <form action="admin_process.php" method="POST" class="mb-4">
                <input type="text" name="announcement" placeholder="New Announcement" class="border p-2 rounded w-full" required>
                <button type="submit" name="add_announcement" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add Announcement</button>
            </form>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold">Current Announcements:</h4>
                <ul id="announcementList">
                    <!-- Dynamic list of announcements will be populated here -->
                </ul>
            </div>
        </section>

        <!-- News Section -->
        <section class="mb-8">
            <h3 class="text-2xl font-semibold mb-2">Manage News</h3>
            <form action="admin_process.php" method="POST" class="mb-4">
                <input type="text" name="news_title" placeholder="News Title" class="border p-2 rounded w-full" required>
                <textarea name="news_content" placeholder="News Content" class="border p-2 rounded w-full" required></textarea>
                <button type="submit" name="add_news" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add News</button>
            </form>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold">Current News:</h4>
                <ul id="newsList">
                    <!-- Dynamic list of news will be populated here -->
                </ul>
            </div>
        </section>

        <!-- User Management Section -->
        <section>
            <h3 class="text-2xl font-semibold mb-2">User Management</h3>
            <form action="admin_process.php" method="POST" class="mb-4">
                <input type="text" name="username" placeholder="New User Username" class="border p-2 rounded w-full" required>
                <input type="password" name="password" placeholder="New User Password" class="border p-2 rounded w-full" required>
                <button type="submit" name="add_user" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add User</button>
            </form>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h4 class="font-bold">Current Users:</h4>
                <ul id="userList">
                    <!-- Dynamic list of users will be populated here -->
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
        // JavaScript to handle dynamic content loading can be added here
    </script>
</body>
</html>

### Explanation:
1. **Header**: The header includes a logo and navigation links to the home page and a logout option.
2. **Admin Dashboard**: The main content area includes sections for managing announcements, news, and users.
3. **Forms**: Each section has a form for adding new announcements, news, and users. The forms submit to a hypothetical `admin_process.php` file, which would handle the backend logic for processing these requests.
4. **Dynamic Lists**: Placeholders for current announcements, news, and users are included, which can be populated dynamically using JavaScript or server-side rendering.

### Next Steps:
- Implement the backend logic in `admin_process.php` to handle form submissions and manage the database.
- Add authentication to ensure only authorized users can access the admin page.
- Consider adding edit and delete functionalities for announcements, news, and users.