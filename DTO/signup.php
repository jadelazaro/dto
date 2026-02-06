<?php
// Signup Page - create a non-admin user
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config.php';

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < PASSWORD_MIN_LENGTH) {
        $error = 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters.';
    } else {
        // Check if username or email exists
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows > 0) {
            $error = 'Username or email already in use.';
            $stmt->close();
        } else {
            $stmt->close();
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $insert = $mysqli->prepare("INSERT INTO users (username, email, password_hash, role, is_active, created_at) VALUES (?, ?, ?, 'user', TRUE, NOW())");
            if (!$insert) {
                $error = 'Database error: ' . $mysqli->error;
            } else {
                $insert->bind_param('sss', $username, $email, $password_hash);
                if ($insert->execute()) {
                    $success = 'Registration successful. You may now log in.';
                } else {
                    $error = 'Registration failed: ' . $insert->error;
                }
                $insert->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - DTO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
    <style>
        body { background: linear-gradient(135deg,#78350f 0%,#7c2d12 50%,#5a1e0a 100%); }
        .card { background: rgba(255,255,255,0.95); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md card rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="DTO outline (1).png" alt="DTO" class="mx-auto w-20 h-20">
            <h1 class="text-2xl font-bold text-amber-900 mt-2">Create an account</h1>
            <p class="text-sm text-slate-600">Register to access additional features</p>
        </div>

        <?php if ($error): ?>
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                <input name="username" required class="w-full px-4 py-2 border rounded" placeholder="Choose a username">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input name="email" type="email" required class="w-full px-4 py-2 border rounded" placeholder="you@example.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input name="password" type="password" required class="w-full px-4 py-2 border rounded" placeholder="Create a password">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                <input name="confirm_password" type="password" required class="w-full px-4 py-2 border rounded" placeholder="Repeat password">
            </div>

            <button type="submit" class="w-full py-3 bg-amber-800 text-white rounded-lg">Sign Up</button>
        </form>

        <div class="mt-4 text-center text-sm">
            <a href="login.php" class="text-amber-700">Already have an account? Sign in</a>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
