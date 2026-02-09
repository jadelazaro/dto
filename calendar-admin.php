<?php
/**
 * Calendar Events Admin Management Page
 * For authenticated admins only
 */

require_once 'config.php';
require_once 'Auth.php';
require_once 'CalendarEventsCRUD.php';

session_start();

$auth = new Auth($mysqli);
$eventsCrud = new CalendarEventsCRUD($mysqli, $auth);

// Check if user is logged in
$isLoggedIn = $auth->isLoggedIn();
$isAdmin = $auth->isAdmin();

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_action'])) {
    header('Content-Type: application/json');
    
    $action = $_POST['api_action'];
    
    switch ($action) {
        case 'create':
            $auth->requireAdmin();
            echo json_encode($eventsCrud->create(
                $_POST['title'] ?? '',
                $_POST['event_date'] ?? '',
                $_POST['description'] ?? '',
                $_POST['event_time'] ?? null,
                $_POST['end_time'] ?? null,
                $_POST['location'] ?? null,
                $_POST['category'] ?? null
            ));
            exit;
            
        case 'update':
            $auth->requireAdmin();
            echo json_encode($eventsCrud->update(
                $_POST['id'] ?? 0,
                $_POST['title'] ?? null,
                $_POST['event_date'] ?? null,
                $_POST['description'] ?? null,
                $_POST['event_time'] ?? null,
                $_POST['end_time'] ?? null,
                $_POST['location'] ?? null,
                $_POST['category'] ?? null,
                $_POST['status'] ?? null
            ));
            exit;
            
        case 'delete':
            $auth->requireAdmin();
            echo json_encode($eventsCrud->delete($_POST['id'] ?? 0));
            exit;
    }
}

// Get events for display
$currentMonth = date('m');
$currentYear = date('Y');

if (isset($_GET['month'])) {
    $currentMonth = (int)$_GET['month'];
}
if (isset($_GET['year'])) {
    $currentYear = (int)$_GET['year'];
}

$events = [];
if ($isLoggedIn) {
    $result = $eventsCrud->getByMonth($currentYear, $currentMonth);
    if ($result['success']) {
        $events = $result['data'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Events Admin - DTO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }
        
        .modal-content {
            animation: slideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .event-row {
            animation: fadeIn 0.3s ease;
            transition: all 0.3s ease;
        }
        
        .event-row:hover {
            background-color: #f0fdf4;
        }
    </style>
</head>
<body class="bg-slate-50">
    <?php if (!$isLoggedIn): ?>
    <!-- Login Form -->
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-green-800">Calendar Admin</h1>
                <p class="text-slate-600 mt-2">Please log in to manage events</p>
            </div>
            
            <form id="loginForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                    <input type="text" id="username" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" id="password" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                
                <button type="submit" class="w-full px-4 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium">
                    Login
                </button>
            </form>
            
            <div id="loginMessage" class="mt-4 p-3 rounded-lg hidden"></div>
        </div>
    </div>
    
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const messageDiv = document.getElementById('loginMessage');
            
            try {
                const response = await fetch('api/auth.php?action=login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({ username, password })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    messageDiv.textContent = 'Login successful! Redirecting...';
                    messageDiv.className = 'mt-4 p-3 rounded-lg bg-green-100 text-green-800';
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    messageDiv.textContent = result.message || 'Login failed';
                    messageDiv.className = 'mt-4 p-3 rounded-lg bg-red-100 text-red-800';
                }
            } catch (error) {
                messageDiv.textContent = 'Error: ' + error.message;
                messageDiv.className = 'mt-4 p-3 rounded-lg bg-red-100 text-red-800';
            }
        });
    </script>
    
    <?php elseif (!$isAdmin): ?>
    <!-- Access Denied -->
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md text-center">
            <i data-lucide="lock" class="w-16 h-16 text-red-600 mx-auto mb-4"></i>
            <h1 class="text-2xl font-bold text-red-600 mb-2">Access Denied</h1>
            <p class="text-slate-600 mb-6">You need admin privileges to access this page.</p>
            <a href="calendar.php" class="inline-block px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition">
                Back to Calendar
            </a>
        </div>
    </div>
    
    <script>
        lucide.createIcons();
    </script>
    
    <?php else: ?>
    <!-- Admin Dashboard -->
    <div class="min-h-screen bg-slate-50">
        <!-- Header -->
        <header class="bg-gradient-to-r from-green-800 to-green-600 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Calendar Events Management</h1>
                        <p class="text-green-100 mt-1">Admin Panel - Manage all calendar events</p>
                    </div>
                    <div class="flex gap-2">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="api_action" value="logout">
                            <button onclick="logoutAdmin()" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Controls -->
            <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
                <div class="flex gap-4">
                    <select id="monthSelect" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?php echo $m; ?>" <?php echo $m == $currentMonth ? 'selected' : ''; ?>>
                            <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                    
                    <select id="yearSelect" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        <?php for ($y = date('Y') - 1; $y <= date('Y') + 2; $y++): ?>
                        <option value="<?php echo $y; ?>" <?php echo $y == $currentYear ? 'selected' : ''; ?>>
                            <?php echo $y; ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <button id="addEventBtn" class="px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add Event</span>
                </button>
            </div>
            
            <!-- Events Table -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Title</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Category</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Time</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-slate-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="eventsTableBody">
                            <?php if (empty($events)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                                    <i data-lucide="calendar" class="w-8 h-8 mx-auto mb-2"></i>
                                    <p>No events found for this month</p>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($events as $event): ?>
                                <tr class="event-row border-b hover:bg-slate-50">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900"><?php echo date('M d, Y', strtotime($event['event_date'])); ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-700"><?php echo htmlspecialchars($event['title']); ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            <?php echo htmlspecialchars($event['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        <?php echo $event['event_time'] ? date('h:i A', strtotime($event['event_time'])) : 'All Day'; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-3 py-1 <?php echo $event['status'] === 'scheduled' ? 'bg-blue-100 text-blue-800' : ($event['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?> rounded-full text-xs font-semibold">
                                            <?php echo ucfirst($event['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <button class="text-blue-600 hover:text-blue-700 mr-3 edit-event" data-id="<?php echo $event['id']; ?>">Edit</button>
                                        <button class="text-red-600 hover:text-red-700 delete-event" data-id="<?php echo $event['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Event Modal -->
    <div id="eventModal" class="modal-overlay hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-green-800" id="modalTitle">Add New Event</h3>
                    <button id="closeModal" class="text-slate-500 hover:text-slate-700">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <form id="eventForm" class="space-y-4">
                    <input type="hidden" id="eventId">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Title *</label>
                            <input type="text" id="eventTitle" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Category *</label>
                            <select id="eventCategory" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                <option value="">Select Category</option>
                                <option value="strategy">Strategy</option>
                                <option value="training">Training</option>
                                <option value="workshop">Workshop</option>
                                <option value="conference">Conference</option>
                                <option value="deadline">Deadline</option>
                                <option value="review">Review</option>
                                <option value="ceremony">Ceremony</option>
                                <option value="assessment">Assessment</option>
                                <option value="planning">Planning</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Event Date *</label>
                            <input type="date" id="eventDate" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Location</label>
                            <input type="text" id="eventLocation" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Start Time</label>
                            <input type="time" id="eventStartTime" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">End Time</label>
                            <input type="time" id="eventEndTime" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Description *</label>
                        <textarea id="eventDescription" required rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select id="eventStatus" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" id="cancelBtn" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Save Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        lucide.createIcons();
        
        const API_BASE = 'api';
        const eventModal = document.getElementById('eventModal');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const addEventBtn = document.getElementById('addEventBtn');
        const eventForm = document.getElementById('eventForm');
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        
        // Open modal for new event
        addEventBtn.addEventListener('click', () => {
            document.getElementById('modalTitle').textContent = 'Add New Event';
            document.getElementById('eventId').value = '';
            eventForm.reset();
            eventModal.classList.remove('hidden');
        });
        
        // Close modal
        closeModal.addEventListener('click', () => {
            eventModal.classList.add('hidden');
        });
        
        cancelBtn.addEventListener('click', () => {
            eventModal.classList.add('hidden');
        });
        
        eventModal.addEventListener('click', (e) => {
            if (e.target === eventModal) {
                eventModal.classList.add('hidden');
            }
        });
        
        // Form submission
        eventForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const id = document.getElementById('eventId').value;
            const isUpdate = !!id;
            
            const eventData = {
                title: document.getElementById('eventTitle').value,
                event_date: document.getElementById('eventDate').value,
                description: document.getElementById('eventDescription').value,
                event_time: document.getElementById('eventStartTime').value || null,
                end_time: document.getElementById('eventEndTime').value || null,
                location: document.getElementById('eventLocation').value,
                category: document.getElementById('eventCategory').value,
                status: document.getElementById('eventStatus').value
            };
            
            try {
                const url = isUpdate ? `${API_BASE}/events.php` : `${API_BASE}/events.php`;
                const method = isUpdate ? 'PUT' : 'POST';
                
                if (isUpdate) {
                    eventData.id = id;
                }
                
                const response = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify(eventData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert(isUpdate ? 'Event updated successfully!' : 'Event created successfully!');
                    eventModal.classList.add('hidden');
                    location.reload();
                } else {
                    alert('Error: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }
        });
        
        // Edit event
        document.addEventListener('click', (e) => {
            if (e.target.closest('.edit-event')) {
                const eventId = e.target.closest('.edit-event').getAttribute('data-id');
                // Implementation would fetch event details and populate form
                alert('Edit functionality requires database event ID: ' + eventId);
            }
            
            if (e.target.closest('.delete-event')) {
                const eventId = e.target.closest('.delete-event').getAttribute('data-id');
                if (confirm('Are you sure you want to delete this event?')) {
                    deleteEvent(eventId);
                }
            }
        });
        
        async function deleteEvent(id) {
            try {
                const response = await fetch(`${API_BASE}/events.php`, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({ id: id })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Event deleted successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }
        
        function logoutAdmin() {
            fetch('api/auth.php?action=logout', {
                method: 'POST',
                credentials: 'include'
            }).then(() => {
                window.location.href = 'calendar.php';
            });
        }
        
        // Navigate months
        monthSelect.addEventListener('change', () => {
            const month = monthSelect.value;
            const year = yearSelect.value;
            window.location.href = `?month=${month}&year=${year}`;
        });
        
        yearSelect.addEventListener('change', () => {
            const month = monthSelect.value;
            const year = yearSelect.value;
            window.location.href = `?month=${month}&year=${year}`;
        });
    </script>
    
    <?php endif; ?>
</body>
</html>
