To create a new admin page for the Digital Transformation Office (DTO) website, you can follow this structure. The admin page will include sections for managing announcements, news, and user accounts. Below is a sample HTML structure for the admin page:

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
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            <nav class="flex gap-6 items-center">
                <a href="index.php" class="hover:text-indigo-200 transition">Home</a>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">Logout</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold mb-4">Manage Content</h2>

        <!-- Announcements Section -->
        <section class="mb-8">
            <h3 class="text-xl font-semibold mb-2">Announcements</h3>
            <form class="mb-4">
                <input type="text" placeholder="New Announcement" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add Announcement</button>
            </form>
            <ul class="list-disc pl-5">
                <li>Announcement 1 <button class="text-red-600">Delete</button></li>
                <li>Announcement 2 <button class="text-red-600">Delete</button></li>
            </ul>
        </section>

        <!-- News Section -->
        <section class="mb-8">
            <h3 class="text-xl font-semibold mb-2">News</h3>
            <form class="mb-4">
                <input type="text" placeholder="New News Item" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add News</button>
            </form>
            <ul class="list-disc pl-5">
                <li>News Item 1 <button class="text-red-600">Delete</button></li>
                <li>News Item 2 <button class="text-red-600">Delete</button></li>
            </ul>
        </section>

        <!-- User Management Section -->
        <section>
            <h3 class="text-xl font-semibold mb-2">User Management</h3>
            <form class="mb-4">
                <input type="text" placeholder="New User Email" class="border rounded p-2 w-full" required>
                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Add User</button>
            </form>
            <ul class="list-disc pl-5">
                <li>User 1 <button class="text-red-600">Delete</button></li>
                <li>User 2 <button class="text-red-600">Delete</button></li>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 text-center">
            <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>

This admin page includes sections for managing announcements, news, and user accounts. Each section has a form to add new items and a list displaying existing items with delete buttons. You can expand the functionality by adding backend logic to handle form submissions and data management.