<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .calendar-carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .calendar-month {
            min-width: 100%;
        }
        
        .event-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .event-card.active {
            border-color: #ef4444;
            background-color: #fef2f2;
            animation: pulse 2s infinite;
        }
        
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 9999px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            animation: pulse 1.5s infinite;
        }
        
        .date-highlight {
            color: #ef4444;
            font-weight: bold;
            position: relative;
        }
        
        .date-highlight::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #ef4444;
            border-radius: 1px;
        }
        
        .carousel-nav-btn {
            transition: all 0.3s ease;
        }
        
        .carousel-nav-btn:hover {
            transform: scale(1.1);
            background-color: #065f46;
        }
        
        .carousel-nav-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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
        
        .event-form {
            animation: slideIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .floating-add-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 100;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-3xl font-bold">DTO</h1>
            </div>
            <nav class="hidden md:flex gap-6">
                <a href="index.php#home" class="hover:text-indigo-200 transition">Home</a>
                <a href="announcements.php" class="hover:text-indigo-200 transition">Announcements</a>
                <a href="news.php" class="hover:text-indigo-200 transition">News</a>
                <a href="calendar.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Calendar</a>
                <a href="index.php#faq" class="hover:text-indigo-200 transition">FAQ</a>
                <a href="index.php#contact" class="hover:text-indigo-200 transition">Contact</a>
            </nav>
            <div class="flex items-center gap-4">
                <div id="userStatusDisplay" class="text-sm hidden md:flex items-center gap-2">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                    <span id="usernameDisplay" class="text-white">Guest</span>
                </div>
            </div>
            <button class="md:hidden" id="mobileMenuBtn">
                <i data-lucide="menu" class="w-8 h-8 text-white"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-gradient-to-r from-amber-800 to-red-900 text-white py-4 px-6" id="mobileMenu">
        <div class="flex flex-col gap-4">
            <a href="index.php#home" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">Home</a>
            <a href="announcements.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">Announcements</a>
            <a href="news.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">News</a>
            <a href="calendar.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700 font-bold text-amber-300">Calendar</a>
            <a href="index.php#faq" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">FAQ</a>
            <a href="index.php#contact" class="hover:text-indigo-200 transition py-2">Contact</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative text-white min-h-[70vh] px-6 lg:px-8 text-center overflow-hidden flex items-center justify-center" id="home">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover" style="background-image: url('DTO PICS(1).jpg'); background-position: center; background-size: cover;"></div>
        
        <!-- Maroon Glassmorphism Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-amber-900 to-red-900 opacity-75 backdrop-blur-sm"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 z-10 py-16">
            <h2 class="text-5xl lg:text-7xl font-black mb-6 drop-shadow-2xl" style="text-shadow: 0 4px 0 rgba(139, 0, 0, 0.8), 0 8px 0 rgba(165, 0, 0, 0.6), 0 12px 20px rgba(0, 0, 0, 0.5); color: rgb(255 255 255 / 1);">Events Calendar</h2>
            <p class="text-xl lg:text-2xl max-w-3xl mx-auto text-slate-100 drop-shadow-lg">Browse upcoming events and get notified for important dates</p>
        </div>
    </section>


    <!-- Add Event Modal -->
    <div id="addEventModal" class="modal-overlay hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 event-form">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-green-800" id="modalTitle">Add New Event</h3>
                        <p class="text-sm text-slate-500 mt-1" id="modalSubtitle">Create a new event on the calendar</p>
                    </div>
                    <button id="closeModal" class="p-2 hover:bg-slate-100 rounded-full transition">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <form id="eventForm" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Event Title *</label>
                            <input type="text" id="eventTitle" required 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Event Category *</label>
                            <select id="eventCategory" required 
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                            <label class="block text-sm font-medium text-slate-700 mb-1">Start Date *</label>
                            <input type="date" id="startDate" required 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">End Date (Optional)</label>
                            <input type="date" id="endDate" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Start Time</label>
                            <input type="time" id="startTime" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">End Time</label>
                            <input type="time" id="endTime" 
                                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Event Description *</label>
                        <textarea id="eventDescription" required rows="4"
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="eventNotification" class="w-4 h-4 text-green-600">
                        <label for="eventNotification" class="text-sm text-slate-700">Enable notification for this event</label>
                    </div>
                    
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" id="cancelEvent" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                            Cancel
                        </button>
                        <button type="submit" id="submitButton" class="px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Add Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modal-overlay hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 event-form">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-center text-slate-900 mb-2">Delete Event?</h3>
                <p class="text-center text-slate-600 mb-2" id="deleteEventTitle"></p>
                <p class="text-center text-slate-500 text-sm mb-6">This action cannot be undone. The event will be permanently deleted.</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" id="cancelDelete" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="button" id="confirmDelete" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        Delete Event
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal (Read/View) -->
    <div id="eventDetailsModal" class="modal-overlay hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 event-form">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <div id="detailCategory" class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold mb-2"></div>
                        <h3 id="detailTitle" class="text-2xl font-bold text-slate-900"></h3>
                        <p id="detailDate" class="text-slate-500 text-sm mt-1"></p>
                    </div>
                    <button id="closeDetailsModal" class="p-2 hover:bg-slate-100 rounded-full transition">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                
                <div class="space-y-4 mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-slate-700">Time</label>
                            <p id="detailTime" class="text-slate-900 mt-1">All Day Event</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-slate-700">Duration</label>
                            <p id="detailDuration" class="text-slate-900 mt-1">-</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-slate-700">Description</label>
                        <p id="detailDescription" class="text-slate-900 mt-2 leading-relaxed"></p>
                    </div>
                    
                    <div id="detailLocationContainer" class="hidden">
                        <label class="text-sm font-medium text-slate-700">Location</label>
                        <p id="detailLocation" class="text-slate-900 mt-1"></p>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" id="editEventBtn" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                        <i data-lucide="edit" class="w-4 h-4 inline mr-2"></i>Edit
                    </button>
                    <button type="button" id="deleteEventBtn" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        <i data-lucide="trash-2" class="w-4 h-4 inline mr-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Section -->
    <section class="bg-white my-8 rounded-lg shadow-lg p-4 md:p-8 max-w-7xl mx-4 md:mx-auto" id="calendar">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-800 pb-2 inline-block">Events Calendar</h2>
                <p class="text-slate-600 mt-2">Navigate through months using the carousel. Today's events are highlighted.</p>
            </div>
            
            <!-- Notification Controls -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <button id="addEventHeaderBtn" class="px-4 py-2 bg-gradient-to-r from-green-800 to-green-600 text-white rounded-lg hover:from-green-700 hover:to-green-500 transition font-medium flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add Event</span>
                </button>
                <div class="flex items-center gap-2">
                    <button id="toggleNotifications" class="px-4 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-2">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                        <span id="notificationText">Enable Notifications</span>
                    </button>
                    <button id="clearNotifications" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition font-medium flex items-center gap-2">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span>Clear</span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Notification Alert -->
        <div id="notificationAlert" class="hidden mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-start">
                <i data-lucide="alert-circle" class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0"></i>
                <div>
                    <h3 class="font-bold text-red-800">Event Notification</h3>
                    <p id="notificationMessage" class="text-red-700"></p>
                    <p class="text-red-600 text-sm mt-1">You can disable notifications using the button above.</p>
                </div>
            </div>
        </div>
        
        <!-- Carousel Container -->
        <div class="relative mb-8">
            <!-- Carousel Navigation -->
            <div class="flex justify-between items-center mb-6">
                <button id="prevMonth" class="carousel-nav-btn p-3 bg-green-800 text-white rounded-full hover:bg-green-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-6 h-6"></i>
                </button>
                
                <div class="text-center">
                    <h3 id="currentMonth" class="text-2xl font-bold text-green-800">August 2026</h3>
                    <p class="text-slate-600">Swipe or use buttons to navigate months</p>
                </div>
                
                <button id="nextMonth" class="carousel-nav-btn p-3 bg-green-800 text-white rounded-full hover:bg-green-700 transition">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Month Indicators -->
            <div class="flex justify-center gap-2 mb-6">
                <button class="month-indicator w-3 h-3 rounded-full bg-green-300" data-month="0"></button>
                <button class="month-indicator w-3 h-3 rounded-full bg-green-800" data-month="1"></button>
                <button class="month-indicator w-3 h-3 rounded-full bg-green-300" data-month="2"></button>
            </div>
            
            <!-- Carousel -->
            <div class="overflow-hidden">
                <div class="calendar-carousel" id="calendarCarousel">
                    
                    <!-- August 2026 -->
                    <div class="calendar-month" data-month="august" data-year="2026">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="augustEvents">
                            <!-- Events will be dynamically added here -->
                            <!-- Existing events will be loaded from storage -->
                        </div>
                    </div>
                    
                    <!-- October 2026 -->
                    <div class="calendar-month" data-month="october" data-year="2026">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="octoberEvents">
                            <!-- Events will be dynamically added here -->
                            <!-- Existing events will be loaded from storage -->
                        </div>
                    </div>
                    
                    <!-- December 2026 -->
                    <div class="calendar-month" data-month="december" data-year="2026">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="decemberEvents">
                            <!-- Events will be dynamically added here -->
                            <!-- Existing events will be loaded from storage -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Upcoming Events Summary -->
        <div class="bg-green-50 p-6 rounded-lg border border-green-200">
            <h3 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
                <i data-lucide="bell-ring" class="w-5 h-5"></i>
                Upcoming Event Notifications
            </h3>
            <div id="upcomingEvents" class="space-y-3">
                <!-- Events will be populated by JavaScript -->
            </div>
            <p class="text-slate-600 text-sm mt-4">Notifications will appear here for events happening today or in the near future.</p>
        </div>
    </section>

    <!-- Contact & Authentication Section -->
    <section id="contact" class="bg-white my-8 rounded-lg shadow-lg p-4 md:p-8 max-w-7xl mx-4 md:mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Contact Us</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <i data-lucide="phone" class="w-6 h-6 text-amber-800"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Phone</h4>
                            <p class="text-slate-600">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <i data-lucide="mail" class="w-6 h-6 text-amber-800"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Email</h4>
                            <p class="text-slate-600">info@dto.org</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <i data-lucide="map-pin" class="w-6 h-6 text-amber-800"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Address</h4>
                            <p class="text-slate-600">123 Education Street<br>Digital City, DC 12345</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login/Logout Area -->
            <div class="bg-gradient-to-br from-amber-50 to-red-50 p-6 rounded-lg border border-amber-200">
                <h3 class="text-2xl font-bold text-amber-900 mb-4">Admin Access</h3>
                <p class="text-slate-700 mb-6">Login to access admin features and manage events.</p>
                
                <div id="authPlaceholder" class="space-y-3">
                    <button id="loginBtnFooter" class="w-full px-6 py-3 bg-amber-800 text-white rounded-lg hover:bg-amber-700 transition font-medium flex items-center justify-center gap-2">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        Admin Login
                    </button>
                    <button id="logoutBtnFooter" class="hidden w-full px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium flex items-center justify-center gap-2">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Logout
                    </button>
                </div>
                
                <div id="adminStatusFooter" class="hidden mt-6 p-4 bg-white rounded border border-green-200">
                    <p class="text-sm text-slate-600 mb-2">Logged in as:</p>
                    <p class="text-lg font-semibold text-green-800" id="usernameFooter">-</p>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Logout Confirmation Modal -->
    <div id="logoutConfirmModal" class="modal-overlay hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 event-form">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-100">
                        <i data-lucide="log-out" class="w-6 h-6 text-amber-600"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-center text-slate-900 mb-2">Sign Out?</h3>
                <p class="text-center text-slate-600 mb-6">Are you sure you want to log out? You will be redirected to the calendar.</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" id="cancelLogout" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="button" id="confirmLogout" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                        Sign Out
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">About DTO</h4>
                    <ul class="space-y-2">
                        <li><a href="index.html#home" class="text-slate-400 hover:text-amber-500 transition">Home</a></li>
                        <li><a href="index.html#about" class="text-slate-400 hover:text-amber-500 transition">About Us</a></li>
                        <li><a href="index.html#programs" class="text-slate-400 hover:text-amber-500 transition">Programs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="index.html#faq" class="text-slate-400 hover:text-amber-500 transition">FAQ</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Student Portal</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Library</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Terms of Service</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Cookie Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Connect</h4>
                    <div class="flex gap-3">
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 pt-8 text-center text-slate-400">
                <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // ===== AUTHENTICATION FUNCTIONS =====
        
        // Check user authentication status
        async function checkAuthStatus() {
            try {
                const response = await fetch('api/auth.php?action=status', {
                    credentials: 'include'
                });
                const result = await response.json();
                updateAuthUI(result.is_logged_in, result.username, result.role);
                return result;
            } catch (error) {
                console.log('Auth status check failed');
                updateAuthUI(false, 'Guest', null);
            }
        }
        
        // Update UI based on auth status
        function updateAuthUI(isLoggedIn, username, role) {
            const userStatusDisplay = document.getElementById('userStatusDisplay');
            const usernameDisplay = document.getElementById('usernameDisplay');
            const loginBtn = document.getElementById('loginBtn');
            const logoutBtn = document.getElementById('logoutBtn');
            
            // Footer elements
            const loginBtnFooter = document.getElementById('loginBtnFooter');
            const logoutBtnFooter = document.getElementById('logoutBtnFooter');
            const adminStatusFooter = document.getElementById('adminStatusFooter');
            const usernameFooter = document.getElementById('usernameFooter');
            
            if (isLoggedIn) {
                // Header updates
                if (userStatusDisplay) userStatusDisplay.classList.remove('hidden');
                if (usernameDisplay) usernameDisplay.textContent = username + (role === 'admin' ? ' (Admin)' : '');
                if (loginBtn) loginBtn.classList.add('hidden');
                if (logoutBtn) logoutBtn.classList.remove('hidden');
                
                // Footer updates
                if (loginBtnFooter) loginBtnFooter.classList.add('hidden');
                if (logoutBtnFooter) logoutBtnFooter.classList.remove('hidden');
                if (adminStatusFooter) adminStatusFooter.classList.remove('hidden');
                if (usernameFooter) usernameFooter.textContent = username + (role === 'admin' ? ' (Admin)' : '');
            } else {
                // Header updates
                if (userStatusDisplay) userStatusDisplay.classList.add('hidden');
                if (usernameDisplay) usernameDisplay.textContent = 'Guest';
                if (loginBtn) loginBtn.classList.remove('hidden');
                if (logoutBtn) logoutBtn.classList.add('hidden');
                
                // Footer updates
                if (loginBtnFooter) loginBtnFooter.classList.remove('hidden');
                if (logoutBtnFooter) logoutBtnFooter.classList.add('hidden');
                if (adminStatusFooter) adminStatusFooter.classList.add('hidden');
                if (usernameFooter) usernameFooter.textContent = '-';
            }

                // Show add-event controls only to admins
                try {
                    const addEventHeaderBtn = document.getElementById('addEventHeaderBtn');
                    const addEventBtn = document.getElementById('addEventBtn');
                    if (isLoggedIn && role === 'admin') {
                        if (addEventHeaderBtn) addEventHeaderBtn.classList.remove('hidden');
                        if (addEventBtn) addEventBtn.classList.remove('hidden');
                    } else {
                        if (addEventHeaderBtn) addEventHeaderBtn.classList.add('hidden');
                        if (addEventBtn) addEventBtn.classList.add('hidden');
                    }
                } catch (e) {
                    // ignore DOM errors
                }
        }
        
        // Login handler
        async function performLogin(username, password) {
            try {
                const response = await fetch('api/auth.php?action=login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({ username, password })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Update UI and close modal if present
                    updateAuthUI(true, result.user.username, result.user.role);
                    const modal = document.getElementById('loginModal');
                    if (modal) modal.classList.add('hidden');
                    const form = document.getElementById('loginForm');
                    if (form) form.reset();
                    const errorDiv = document.getElementById('loginError');
                    if (errorDiv) errorDiv.classList.add('hidden');
                    alert('Logged in successfully! Welcome ' + result.user.username);
                    return true;
                } else {
                    // Show error message (if login UI exists)
                    const errorDiv = document.getElementById('loginError');
                    if (errorDiv) {
                        errorDiv.textContent = result.message || 'Login failed';
                        errorDiv.classList.remove('hidden');
                    } else {
                        alert(result.message || 'Login failed');
                    }
                    return false;
                }
            } catch (error) {
                console.error('Login error:', error);
                const errorDiv = document.getElementById('loginError');
                if (errorDiv) {
                    errorDiv.textContent = 'Connection error. Please try again.';
                    errorDiv.classList.remove('hidden');
                } else {
                    alert('Connection error. Please try again.');
                }
                return false;
            }
        }
        
        // Logout handler
        async function performLogout() {
            try {
                const response = await fetch('api/auth.php?action=logout', {
                    method: 'POST',
                    credentials: 'include'
                });
                
                const result = await response.json();
                
                if (result.success) {
                    updateAuthUI(false, 'Guest', null);
                    document.getElementById('logoutConfirmModal').classList.add('hidden');
                    alert('Logged out successfully');
                    // Reload calendar to reflect changes
                    location.reload();
                }
            } catch (error) {
                console.error('Logout error:', error);
                alert('Logout failed. Please try again.');
            }
        }
        
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.setAttribute('data-lucide', 'menu');
                } else {
                    icon.setAttribute('data-lucide', 'x');
                }
                lucide.createIcons();
            });
        }
        
        // API Configuration
        const API_BASE = 'api';
        
        // Calendar Carousel and Event Management System
        document.addEventListener('DOMContentLoaded', function() {
            // Check authentication on page load
            checkAuthStatus();
            
            const carousel = document.getElementById('calendarCarousel');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');
            const monthIndicators = document.querySelectorAll('.month-indicator');
            const currentMonthText = document.getElementById('currentMonth');
            const notificationAlert = document.getElementById('notificationAlert');
            const notificationMessage = document.getElementById('notificationMessage');
            const toggleNotificationsBtn = document.getElementById('toggleNotifications');
            const notificationText = document.getElementById('notificationText');
            const clearNotificationsBtn = document.getElementById('clearNotifications');
            const upcomingEventsList = document.getElementById('upcomingEvents');
            
            // Event management elements
            const addEventBtn = document.getElementById('addEventBtn');
            const addEventHeaderBtn = document.getElementById('addEventHeaderBtn');
            const addEventModal = document.getElementById('addEventModal');
            const closeModal = document.getElementById('closeModal');
            const cancelEvent = document.getElementById('cancelEvent');
            const eventForm = document.getElementById('eventForm');
            
            // API Functions for Event Management
            async function addEventToDatabase(eventData) {
                try {
                    const response = await fetch(`${API_BASE}/events.php`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        credentials: 'include',
                        body: JSON.stringify({
                            title: eventData.title,
                            event_date: eventData.date,
                            event_time: eventData.startTime || null,
                            end_time: eventData.endTime || null,
                            location: '',
                            category: eventData.category,
                            description: eventData.description
                        })
                    });
                    
                    const result = await response.json();
                    if (result.success) {
                        console.log('Event added to database:', result);
                        return result.id;
                    } else {
                        console.log('Database add failed:', result.message);
                        return null;
                    }
                } catch (error) {
                    console.log('Local storage only - Database not available');
                    return null;
                }
            }
            
            async function updateEventInDatabase(id, eventData) {
                try {
                    const response = await fetch(`${API_BASE}/events.php`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        credentials: 'include',
                        body: JSON.stringify({
                            id: id,
                            title: eventData.title,
                            event_date: eventData.date,
                            event_time: eventData.startTime || null,
                            end_time: eventData.endTime || null,
                            category: eventData.category,
                            description: eventData.description
                        })
                    });
                    
                    const result = await response.json();
                    return result.success;
                } catch (error) {
                    console.log('Update failed - local only');
                    return false;
                }
            }
            
            async function deleteEventFromDatabase(id) {
                try {
                    const response = await fetch(`${API_BASE}/events.php`, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        credentials: 'include',
                        body: JSON.stringify({ id: id })
                    });
                    
                    const result = await response.json();
                    return result.success;
                } catch (error) {
                    console.log('Delete failed - local only');
                    return false;
                }
            }
            
            async function fetchEventsFromDatabase(year, month) {
                try {
                    const response = await fetch(`${API_BASE}/events.php?action=month&year=${year}&month=${String(month).padStart(2, '0')}`, {
                        credentials: 'include'
                    });
                    
                    const result = await response.json();
                    if (result.success) {
                        return result.data || [];
                    }
                } catch (error) {
                    console.log('Fetch failed - using local events only');
                }
                return [];
            }
            
            // Event containers
            const augustEvents = document.getElementById('augustEvents');
            const octoberEvents = document.getElementById('octoberEvents');
            const decemberEvents = document.getElementById('decemberEvents');
            
            let currentMonthIndex = 0;
            const totalMonths = 3;
            const months = ['August 2026', 'October 2026', 'December 2026'];
            
            // Event dates with notifications (simulating today's date as 2026-10-24 for demo)
            const today = new Date('2026-10-24'); // Demo: Set to October 24, 2026
            const notificationEnabled = localStorage.getItem('calendarNotifications') === 'true';
            
            // Initialize event storage
            let userEvents = JSON.parse(localStorage.getItem('userCalendarEvents')) || [];
            
            // Initialize notifications state
            if (notificationEnabled) {
                notificationText.textContent = 'Disable Notifications';
                toggleNotificationsBtn.querySelector('i').setAttribute('data-lucide', 'bell-off');
            } else {
                notificationText.textContent = 'Enable Notifications';
                toggleNotificationsBtn.querySelector('i').setAttribute('data-lucide', 'bell');
            }
            lucide.createIcons();
            
            // Sample events data
            const sampleEvents = [
                {
                    id: '1',
                    title: 'Q3 Digital Initiative Kickoff',
                    category: 'strategy',
                    date: '2026-08-11',
                    endDate: null,
                    startTime: '09:00',
                    endTime: '16:00',
                    description: 'Start of Q3 digital transformation initiatives and planning sessions. All department heads required to attend.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '2',
                    title: 'Partner Onboarding Week',
                    category: 'training',
                    date: '2026-08-11',
                    endDate: '2026-08-15',
                    startTime: null,
                    endTime: null,
                    description: 'Training and onboarding sessions for new partner organizations. Includes workshops on our digital tools and processes.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '3',
                    title: 'Technology Workshop Series',
                    category: 'workshop',
                    date: '2026-08-18',
                    endDate: null,
                    startTime: '13:00',
                    endTime: '17:00',
                    description: 'First workshop in our technology training series for 2026. Focus on cloud computing and DevOps practices.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '4',
                    title: 'Cloud Migration Conference',
                    category: 'conference',
                    date: '2026-10-05',
                    endDate: null,
                    startTime: '08:00',
                    endTime: '18:00',
                    description: 'Industry conference on cloud migration best practices and trends. Featuring keynote speakers from leading tech companies.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '5',
                    title: 'Phase 2 Development Deadline',
                    category: 'deadline',
                    date: '2026-10-24',
                    endDate: null,
                    startTime: null,
                    endTime: null,
                    description: 'Deadline for Phase 2 development deliverables and submissions. All teams must submit their progress reports.',
                    notification: true,
                    isSample: true
                },
                {
                    id: '6',
                    title: 'Mid-Year Progress Review',
                    category: 'review',
                    date: '2026-10-27',
                    endDate: '2026-10-29',
                    startTime: '09:00',
                    endTime: '17:00',
                    description: 'Comprehensive review of transformation initiatives and progress. Includes presentations from all departments.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '7',
                    title: 'Annual Awards Ceremony',
                    category: 'ceremony',
                    date: '2026-12-08',
                    endDate: null,
                    startTime: '18:00',
                    endTime: '22:00',
                    description: 'Celebration and recognition of outstanding contributions to digital transformation. Formal attire recommended.',
                    notification: false,
                    isSample: true
                },
                {
                    id: '8',
                    title: 'Year-End Assessment',
                    category: 'assessment',
                    date: '2026-12-10',
                    endDate: '2026-12-12',
                    startTime: null,
                    endTime: null,
                    description: 'Final assessment of all digital transformation projects for the year. External auditors will be present.',
                    notification: true,
                    isSample: true
                },
                {
                    id: '9',
                    title: 'Strategic Planning for 2027',
                    category: 'planning',
                    date: '2026-12-15',
                    endDate: '2026-12-20',
                    startTime: '09:00',
                    endTime: '17:00',
                    description: 'Planning and strategy sessions for the next fiscal year. Executive leadership team required for all sessions.',
                    notification: true,
                    isSample: true
                }
            ];
            
            // Check admin authentication
            async function checkAdminAccess() {
                try {
                    const response = await fetch('api/auth.php?action=status', {
                        credentials: 'include'
                    });
                    const result = await response.json();
                    return result.isAdmin || false;
                } catch (error) {
                    return false;
                }
            }
            
            // Load events on page load
            function loadEvents() {
                // Clear existing events
                augustEvents.innerHTML = '';
                octoberEvents.innerHTML = '';
                decemberEvents.innerHTML = '';
                
                // Load sample events if no user events exist
                if (userEvents.length === 0) {
                    userEvents = sampleEvents;
                    localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
                }
                
                // Render all events
                userEvents.forEach(event => {
                    renderEvent(event);
                });
            }
            
            // Render a single event
            function renderEvent(event) {
                const eventDate = new Date(event.date);
                const month = eventDate.getMonth();
                const day = eventDate.getDate();
                const monthName = eventDate.toLocaleString('default', { month: 'long' }).toUpperCase();
                const year = eventDate.getFullYear();
                
                // Create event card
                const eventCard = document.createElement('div');
                eventCard.className = 'event-card bg-white p-6 rounded-lg border-t-4 border-green-800 shadow-md relative';
                eventCard.setAttribute('data-date', event.date);
                eventCard.setAttribute('data-id', event.id);
                
                // Format date display
                let dateDisplay = `${day}`;
                if (event.endDate) {
                    const endDate = new Date(event.endDate);
                    dateDisplay = `${day}-${endDate.getDate()}`;
                }
                
                // Format time display
                let timeDisplay = 'All Day Event';
                if (event.startTime && event.endTime) {
                    timeDisplay = `${formatTime(event.startTime)} - ${formatTime(event.endTime)}`;
                } else if (event.startTime) {
                    timeDisplay = `From ${formatTime(event.startTime)}`;
                }
                
                // Get category info
                const categoryInfo = getCategoryInfo(event.category);
                
                // Create event card HTML
                eventCard.innerHTML = `
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <div class="text-3xl font-bold text-green-800 mb-1">${dateDisplay}</div>
                            <div class="text-slate-500 text-sm mb-2 font-semibold">${monthName} ${year}</div>
                        </div>
                        <div class="relative">
                            <i data-lucide="calendar" class="w-6 h-6 text-green-600"></i>
                            ${event.notification ? '<span class="notification-badge">!</span>' : ''}
                        </div>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg mb-2">${event.title}</h3>
                    <p class="text-slate-600 text-sm mb-4">${event.description}</p>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">${timeDisplay}</span>
                        <span class="px-3 py-1 ${categoryInfo.color} text-${categoryInfo.textColor} rounded-full text-xs font-semibold">${categoryInfo.label}</span>
                    </div>
                    ${!event.isSample ? '<button class="delete-event absolute bottom-4 right-4 text-red-500 hover:text-red-700" title="Delete event"><i data-lucide="trash-2" class="w-4 h-4"></i></button>' : ''}
                `;
                
                // Add event card to appropriate month container
                if (month === 7) { // August (month index 7)
                    augustEvents.appendChild(eventCard);
                } else if (month === 9) { // October (month index 9)
                    octoberEvents.appendChild(eventCard);
                } else if (month === 11) { // December (month index 11)
                    decemberEvents.appendChild(eventCard);
                }
                
                // Add event listener to delete button if it's a user event
                if (!event.isSample) {
                    const deleteBtn = eventCard.querySelector('.delete-event');
                    deleteBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        deleteEventId = event.id;
                        deleteEventTitle.textContent = `"${event.title}" - ${event.date}`;
                        deleteConfirmModal.classList.remove('hidden');
                    });
                }
                
                // Add click event to show details in modal
                eventCard.addEventListener('click', function() {
                    openEventDetailsModal(event.id);
                });
                
                // Re-initialize icons
                lucide.createIcons();
            }
            
            // Format time for display
            function formatTime(timeString) {
                if (!timeString) return '';
                const [hours, minutes] = timeString.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const displayHour = hour % 12 || 12;
                return `${displayHour}:${minutes} ${ampm}`;
            }
            
            // Get category styling info
            function getCategoryInfo(category) {
                const categories = {
                    strategy: { label: 'Strategy', color: 'bg-green-100', textColor: 'green-800' },
                    training: { label: 'Training', color: 'bg-blue-100', textColor: 'blue-800' },
                    workshop: { label: 'Workshop', color: 'bg-purple-100', textColor: 'purple-800' },
                    conference: { label: 'Conference', color: 'bg-blue-100', textColor: 'blue-800' },
                    deadline: { label: 'Deadline', color: 'bg-red-100', textColor: 'red-800' },
                    review: { label: 'Review', color: 'bg-green-100', textColor: 'green-800' },
                    ceremony: { label: 'Ceremony', color: 'bg-amber-100', textColor: 'amber-800' },
                    assessment: { label: 'Assessment', color: 'bg-purple-100', textColor: 'purple-800' },
                    planning: { label: 'Planning', color: 'bg-green-100', textColor: 'green-800' }
                };
                return categories[category] || { label: 'Event', color: 'bg-slate-100', textColor: 'slate-800' };
            }
            
            // Delete an event
            async function deleteEvent(eventId) {
                if (confirm('Are you sure you want to delete this event?')) {
                    // Try to delete from database if it's a database ID
                    if (!eventId.startsWith('user_')) {
                        const dbDeleted = await deleteEventFromDatabase(eventId);
                        if (!dbDeleted) {
                            console.log('Could not delete from database, removing from local storage only');
                        }
                    }
                    
                    // Remove from local storage
                    userEvents = userEvents.filter(event => event.id !== eventId);
                    localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
                    
                    // Reload events display
                    loadEvents();
                    checkForTodayEvents();
                    
                    alert('Event deleted successfully!');
                }
            }
            
            // Update carousel position
            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentMonthIndex * 100}%)`;
                currentMonthText.textContent = months[currentMonthIndex];
                
                // Update indicators
                monthIndicators.forEach((indicator, index) => {
                    if (index === currentMonthIndex) {
                        indicator.classList.remove('bg-green-300');
                        indicator.classList.add('bg-green-800');
                    } else {
                        indicator.classList.remove('bg-green-800');
                        indicator.classList.add('bg-green-300');
                    }
                });
                
                // Update button states
                prevBtn.disabled = currentMonthIndex === 0;
                nextBtn.disabled = currentMonthIndex === totalMonths - 1;
                
                if (prevBtn.disabled) {
                    prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                
                if (nextBtn.disabled) {
                    nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                
                // Check for events in current month
                checkForTodayEvents();
            }
            
            // Check for events happening today or soon
            function checkForTodayEvents() {
                const eventCards = document.querySelectorAll('.event-card');
                
                // Clear previous highlights
                eventCards.forEach(card => {
                    card.classList.remove('active');
                    const badge = card.querySelector('.notification-badge');
                    if (badge) badge.style.display = 'none';
                });
                
                // Clear upcoming events list
                upcomingEventsList.innerHTML = '';
                
                let hasUpcomingEvents = false;
                
                // Check each event card
                eventCards.forEach(card => {
                    const eventDateStr = card.getAttribute('data-date');
                    const eventDate = new Date(eventDateStr);
                    const timeDiff = eventDate.getTime() - today.getTime();
                    const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    
                    // Show notification badge for events within 7 days
                    if (dayDiff >= 0 && dayDiff <= 7) {
                        const badge = card.querySelector('.notification-badge');
                        if (badge && notificationEnabled) {
                            badge.style.display = 'flex';
                        }
                    }
                    
                    // Highlight today's events
                    if (eventDate.toDateString() === today.toDateString()) {
                        card.classList.add('active');
                        
                        // Show notification alert
                        if (notificationEnabled) {
                            const eventTitle = card.querySelector('h3').textContent;
                            notificationMessage.textContent = `Today: ${eventTitle}`;
                            notificationAlert.classList.remove('hidden');
                            notificationAlert.style.animation = 'slideIn 0.5s ease-out';
                        }
                        
                        // Add to upcoming events list
                        addToUpcomingEvents(card, 'Today');
                        hasUpcomingEvents = true;
                    }
                    // Highlight events in the next 3 days
                    else if (dayDiff > 0 && dayDiff <= 3) {
                        // Add to upcoming events list
                        addToUpcomingEvents(card, `In ${dayDiff} day${dayDiff > 1 ? 's' : ''}`);
                        hasUpcomingEvents = true;
                    }
                });
                
                // If no upcoming events, show message
                if (!hasUpcomingEvents) {
                    upcomingEventsList.innerHTML = `
                        <div class="text-center py-4 text-slate-500">
                            <i data-lucide="calendar" class="w-8 h-8 mx-auto mb-2"></i>
                            <p>No upcoming events in the next 3 days</p>
                        </div>
                    `;
                    lucide.createIcons();
                }
            }
            
            // Add event to upcoming events list
            function addToUpcomingEvents(card, timeframe) {
                const dateElement = card.querySelector('.text-3xl');
                const monthElement = card.querySelector('.text-slate-500.text-sm');
                const titleElement = card.querySelector('h3');
                const descElement = card.querySelector('p');
                
                const eventItem = document.createElement('div');
                eventItem.className = 'bg-white p-4 rounded border border-green-200';
                eventItem.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-green-800">${dateElement.textContent}</span>
                                <span class="text-slate-500 text-sm">${monthElement.textContent}</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">${timeframe}</span>
                            </div>
                            <h4 class="font-bold text-slate-900 mt-1">${titleElement.textContent}</h4>
                            <p class="text-slate-600 text-sm mt-1">${descElement.textContent}</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-green-600 flex-shrink-0"></i>
                    </div>
                `;
                
                upcomingEventsList.appendChild(eventItem);
            }
            
            // Toggle notifications
            toggleNotificationsBtn.addEventListener('click', function() {
                const newState = !notificationEnabled;
                localStorage.setItem('calendarNotifications', newState);
                
                if (newState) {
                    notificationText.textContent = 'Disable Notifications';
                    this.querySelector('i').setAttribute('data-lucide', 'bell-off');
                    alert('Notifications enabled! You will be alerted for today\'s events and upcoming deadlines.');
                } else {
                    notificationText.textContent = 'Enable Notifications';
                    this.querySelector('i').setAttribute('data-lucide', 'bell');
                    alert('Notifications disabled.');
                }
                
                lucide.createIcons();
                location.reload(); // Reload to apply changes
            });
            
            // Clear notifications
            clearNotificationsBtn.addEventListener('click', function() {
                if (confirm('Clear all notification badges and alerts?')) {
                    const eventCards = document.querySelectorAll('.event-card');
                    eventCards.forEach(card => {
                        const badge = card.querySelector('.notification-badge');
                        if (badge) badge.style.display = 'none';
                        card.classList.remove('active');
                    });
                    
                    notificationAlert.classList.add('hidden');
                    upcomingEventsList.innerHTML = `
                        <div class="text-center py-4 text-slate-500">
                            <i data-lucide="check-circle" class="w-8 h-8 mx-auto mb-2 text-green-500"></i>
                            <p>All notifications cleared</p>
                        </div>
                    `;
                    lucide.createIcons();
                }
            });
            
            // Modal controls
            addEventBtn.addEventListener('click', () => {
                addEventModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            
            addEventHeaderBtn.addEventListener('click', () => {
                addEventModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            
            closeModal.addEventListener('click', () => {
                addEventModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
            
            cancelEvent.addEventListener('click', () => {
                addEventModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                eventForm.reset();
            });
            
            // Close modal when clicking outside
            addEventModal.addEventListener('click', (e) => {
                if (e.target === addEventModal) {
                    addEventModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                    eventForm.reset();
                }
            });
            
            // Handle form submission
            eventForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                // Get form values
                const title = document.getElementById('eventTitle').value;
                const category = document.getElementById('eventCategory').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const startTime = document.getElementById('startTime').value;
                const endTime = document.getElementById('endTime').value;
                const description = document.getElementById('eventDescription').value;
                const notification = document.getElementById('eventNotification').checked;
                
                // Validate required fields
                if (!title || !category || !startDate || !description) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                // Disable submit button
                const submitBtn = eventForm.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Adding...';
                
                // Create new event object
                const newEvent = {
                    title,
                    category,
                    date: startDate,
                    endDate: endDate || null,
                    startTime: startTime || null,
                    endTime: endTime || null,
                    description,
                    notification,
                    isSample: false
                };
                
                // Try to add to database
                const dbId = await addEventToDatabase(newEvent);
                
                if (dbId) {
                    newEvent.id = dbId;
                } else {
                    // Generate local ID
                    newEvent.id = 'user_' + Date.now();
                }
                
                // Add to user events
                userEvents.push(newEvent);
                localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
                
                // Render the new event
                renderEvent(newEvent);
                
                // Close modal and reset form
                addEventModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                eventForm.reset();
                
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Add Event';
                
                // Show success message
                alert('Event added successfully! ' + (dbId ? '(Saved to database)' : '(Local storage)'));
                
                // Update event checking
                checkForTodayEvents();
            });

            // ===== NEW MODAL CONTROLS =====
            
            // Delete confirmation modal
            let deleteEventId = null;
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');
            const deleteEventTitle = document.getElementById('deleteEventTitle');
            
            cancelDelete.addEventListener('click', () => {
                deleteConfirmModal.classList.add('hidden');
                deleteEventId = null;
            });
            
            deleteConfirmModal.addEventListener('click', (e) => {
                if (e.target === deleteConfirmModal) {
                    deleteConfirmModal.classList.add('hidden');
                    deleteEventId = null;
                }
            });
            
            confirmDelete.addEventListener('click', async () => {
                if (deleteEventId) {
                    confirmDelete.disabled = true;
                    confirmDelete.textContent = 'Deleting...';
                    
                    // Try to delete from database
                    await deleteEventFromDatabase(deleteEventId);
                    
                    // Remove from user events
                    userEvents = userEvents.filter(e => e.id !== deleteEventId);
                    localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
                    
                    // Remove from DOM
                    const eventCard = document.querySelector(`[data-id="${deleteEventId}"]`);
                    if (eventCard) eventCard.remove();
                    
                    // Close modals
                    deleteConfirmModal.classList.add('hidden');
                    document.getElementById('eventDetailsModal').classList.add('hidden');
                    
                    // Reset button
                    confirmDelete.disabled = false;
                    confirmDelete.textContent = 'Delete Event';
                    deleteEventId = null;
                    
                    alert('Event deleted successfully!');
                    checkForTodayEvents();
                }
            });
            
            // Event details modal
            const eventDetailsModal = document.getElementById('eventDetailsModal');
            const closeDetailsModal = document.getElementById('closeDetailsModal');
            const editEventBtn = document.getElementById('editEventBtn');
            const deleteEventBtn = document.getElementById('deleteEventBtn');
            
            closeDetailsModal.addEventListener('click', () => {
                eventDetailsModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
            
            eventDetailsModal.addEventListener('click', (e) => {
                if (e.target === eventDetailsModal) {
                    eventDetailsModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
            
            editEventBtn.addEventListener('click', () => {
                const eventId = eventDetailsModal.getAttribute('data-event-id');
                const event = userEvents.find(e => e.id === eventId) || sampleEvents.find(e => e.id === eventId);
                
                if (event) {
                    // Populate form with event data
                    document.getElementById('eventTitle').value = event.title;
                    document.getElementById('eventCategory').value = event.category;
                    document.getElementById('startDate').value = event.date;
                    document.getElementById('endDate').value = event.endDate || '';
                    document.getElementById('startTime').value = event.startTime || '';
                    document.getElementById('endTime').value = event.endTime || '';
                    document.getElementById('eventDescription').value = event.description;
                    document.getElementById('eventNotification').checked = event.notification || false;
                    
                    // Update modal title
                    document.getElementById('modalTitle').textContent = 'Edit Event';
                    document.getElementById('modalSubtitle').textContent = 'Update event details';
                    document.getElementById('submitButton').textContent = 'Update Event';
                    
                    // Store edit mode
                    eventForm.setAttribute('data-edit-id', eventId);
                    
                    // Close details modal and open add/edit modal
                    eventDetailsModal.classList.add('hidden');
                    addEventModal.classList.remove('hidden');
                }
            });
            
            deleteEventBtn.addEventListener('click', () => {
                const eventId = eventDetailsModal.getAttribute('data-event-id');
                const event = userEvents.find(e => e.id === eventId) || sampleEvents.find(e => e.id === eventId);
                
                if (event) {
                    deleteEventId = eventId;
                    deleteEventTitle.textContent = `"${event.title}" - ${event.date}`;
                    eventDetailsModal.classList.add('hidden');
                    deleteConfirmModal.classList.remove('hidden');
                }
            });
            
            // Enhanced form submission for edit mode
            const originalFormHandler = eventForm.onsubmit;
            eventForm.addEventListener('submit', async (e) => {
                const editId = eventForm.getAttribute('data-edit-id');
                
                if (editId) {
                    e.preventDefault();
                    
                    const title = document.getElementById('eventTitle').value;
                    const category = document.getElementById('eventCategory').value;
                    const startDate = document.getElementById('startDate').value;
                    const endDate = document.getElementById('endDate').value;
                    const startTime = document.getElementById('startTime').value;
                    const endTime = document.getElementById('endTime').value;
                    const description = document.getElementById('eventDescription').value;
                    const notification = document.getElementById('eventNotification').checked;
                    
                    if (!title || !category || !startDate || !description) {
                        alert('Please fill in all required fields');
                        return;
                    }
                    
                    const submitBtn = document.getElementById('submitButton');
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Updating...';
                    
                    // Update event
                    const eventIndex = userEvents.findIndex(e => e.id === editId);
                    if (eventIndex !== -1) {
                        userEvents[eventIndex] = {
                            ...userEvents[eventIndex],
                            title,
                            category,
                            date: startDate,
                            endDate: endDate || null,
                            startTime: startTime || null,
                            endTime: endTime || null,
                            description,
                            notification
                        };
                        
                        // Update database if not a sample event
                        if (!editId.startsWith('user_')) {
                            await updateEventInDatabase(editId, userEvents[eventIndex]);
                        }
                        
                        localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
                    }
                    
                    // Reload calendar
                    const augustEvents = document.getElementById('augustEvents');
                    const octoberEvents = document.getElementById('octoberEvents');
                    const decemberEvents = document.getElementById('decemberEvents');
                    
                    augustEvents.innerHTML = '';
                    octoberEvents.innerHTML = '';
                    decemberEvents.innerHTML = '';
                    
                    sampleEvents.forEach(renderEvent);
                    userEvents.forEach(renderEvent);
                    
                    // Reset form
                    addEventModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                    eventForm.reset();
                    eventForm.removeAttribute('data-edit-id');
                    
                    // Reset modal title
                    document.getElementById('modalTitle').textContent = 'Add New Event';
                    document.getElementById('modalSubtitle').textContent = 'Create a new event on the calendar';
                    document.getElementById('submitButton').textContent = 'Add Event';
                    
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Update Event';
                    
                    alert('Event updated successfully!');
                    checkForTodayEvents();
                }
            });
            
            // Function to open event details modal
            function openEventDetailsModal(eventId) {
                const event = userEvents.find(e => e.id === eventId) || sampleEvents.find(e => e.id === eventId);
                
                if (event) {
                    const categoryInfo = getCategoryInfo(event.category);
                    const eventDate = new Date(event.date);
                    const monthName = eventDate.toLocaleString('default', { month: 'long' });
                    const day = eventDate.getDate();
                    const year = eventDate.getFullYear();
                    
                    document.getElementById('detailCategory').textContent = categoryInfo.label;
                    document.getElementById('detailCategory').className = `inline-block px-3 py-1 ${categoryInfo.color} text-${categoryInfo.textColor} rounded-full text-xs font-semibold mb-2`;
                    
                    document.getElementById('detailTitle').textContent = event.title;
                    document.getElementById('detailDate').textContent = `${monthName} ${day}, ${year}`;
                    document.getElementById('detailDescription').textContent = event.description;
                    
                    // Set time display
                    let timeDisplay = 'All Day Event';
                    if (event.startTime && event.endTime) {
                        timeDisplay = `${formatTime(event.startTime)} - ${formatTime(event.endTime)}`;
                    } else if (event.startTime) {
                        timeDisplay = `From ${formatTime(event.startTime)}`;
                    }
                    document.getElementById('detailTime').textContent = timeDisplay;
                    
                    // Set duration
                    if (event.endDate) {
                        const endDate = new Date(event.endDate);
                        const timeDiff = Math.ceil((endDate - eventDate) / (1000 * 60 * 60 * 24));
                        document.getElementById('detailDuration').textContent = `${timeDiff + 1} day${timeDiff !== 0 ? 's' : ''}`;
                    } else {
                        document.getElementById('detailDuration').textContent = '1 day';
                    }
                    
                    // Handle location if it exists
                    if (event.location) {
                        document.getElementById('detailLocationContainer').classList.remove('hidden');
                        document.getElementById('detailLocation').textContent = event.location;
                    } else {
                        document.getElementById('detailLocationContainer').classList.add('hidden');
                    }
                    
                    eventDetailsModal.setAttribute('data-event-id', eventId);
                    
                    // Show/hide edit button based on event type
                    if (event.isSample) {
                        editEventBtn.style.display = 'none';
                        deleteEventBtn.style.display = 'none';
                    } else {
                        editEventBtn.style.display = 'inline-block';
                        deleteEventBtn.style.display = 'inline-block';
                    }
                    
                    eventDetailsModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            // Export function for use in renderEvent
            window.openEventDetailsModal = openEventDetailsModal;
            
            // Carousel navigation
            prevBtn.addEventListener('click', () => {
                if (currentMonthIndex > 0) {
                    currentMonthIndex--;
                    updateCarousel();
                }
            });
            
            nextBtn.addEventListener('click', () => {
                if (currentMonthIndex < totalMonths - 1) {
                    currentMonthIndex++;
                    updateCarousel();
                }
            });
            
            // Month indicator clicks
            monthIndicators.forEach(indicator => {
                indicator.addEventListener('click', () => {
                    const monthIndex = parseInt(indicator.getAttribute('data-month'));
                    currentMonthIndex = monthIndex;
                    updateCarousel();
                });
            });
            
            // Touch/swipe support for carousel
            let touchStartX = 0;
            let touchEndX = 0;
            
            carousel.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            carousel.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                
                if (touchEndX < touchStartX - swipeThreshold) {
                    // Swipe left - next month
                    if (currentMonthIndex < totalMonths - 1) {
                        currentMonthIndex++;
                        updateCarousel();
                    }
                }
                
                if (touchEndX > touchStartX + swipeThreshold) {
                    // Swipe right - previous month
                    if (currentMonthIndex > 0) {
                        currentMonthIndex--;
                        updateCarousel();
                    }
                }
            }
            
            // Keyboard navigation
            document.addEventListener('keydown', e => {
                if (e.key === 'ArrowLeft') {
                    if (currentMonthIndex > 0) {
                        currentMonthIndex--;
                        updateCarousel();
                    }
                } else if (e.key === 'ArrowRight') {
                    if (currentMonthIndex < totalMonths - 1) {
                        currentMonthIndex++;
                        updateCarousel();
                    }
                } else if (e.key === 'Escape') {
                    addEventModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
            
            // ===== LOGIN/LOGOUT HANDLERS =====
            
            const loginBtn = document.getElementById('loginBtn');
            const logoutBtn = document.getElementById('logoutBtn');
            const loginBtnFooter = document.getElementById('loginBtnFooter');
            const logoutBtnFooter = document.getElementById('logoutBtnFooter');
            const loginModal = document.getElementById('loginModal');
            const logoutConfirmModal = document.getElementById('logoutConfirmModal');
            const loginForm = document.getElementById('loginForm');
            const loginSubmitBtn = document.getElementById('loginSubmitBtn');
            const cancelLogin = document.getElementById('cancelLogin');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');

            // Function to open login (redirect to standalone page if modal not present)
            function openLoginModal() {
                if (loginModal) {
                    loginModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    const userField = document.getElementById('loginUsername');
                    if (userField) userField.focus();
                } else {
                    // Fallback to dedicated login page
                    window.location.href = 'login.php';
                }
            }

            // Function to open logout confirmation
            function openLogoutConfirm() {
                if (logoutConfirmModal) {
                    logoutConfirmModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    performLogout();
                }
            }

            // Wire up event listeners only when elements exist
            if (loginBtn) loginBtn.addEventListener('click', openLoginModal);
            if (loginBtnFooter) loginBtnFooter.addEventListener('click', openLoginModal);
            if (logoutBtn) logoutBtn.addEventListener('click', openLogoutConfirm);
            if (logoutBtnFooter) logoutBtnFooter.addEventListener('click', openLogoutConfirm);
            if (cancelLogin) cancelLogin.addEventListener('click', () => {
                if (loginModal) loginModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                if (loginForm) loginForm.reset();
                const loginError = document.getElementById('loginError');
                if (loginError) loginError.classList.add('hidden');
            });
            
            if (loginModal) {
                loginModal.addEventListener('click', (e) => {
                    if (e.target === loginModal) {
                        loginModal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                        if (loginForm) loginForm.reset();
                        const loginError = document.getElementById('loginError');
                        if (loginError) loginError.classList.add('hidden');
                    }
                });
            }

            // Handle login form submission (if present)
            if (loginForm) {
                loginForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const usernameField = document.getElementById('loginUsername');
                    const passwordField = document.getElementById('loginPassword');
                    const usernameVal = usernameField ? usernameField.value : '';
                    const passwordVal = passwordField ? passwordField.value : '';

                    if (loginSubmitBtn) {
                        loginSubmitBtn.disabled = true;
                        loginSubmitBtn.textContent = 'Logging in...';
                    }

                    const success = await performLogin(usernameVal, passwordVal);

                    if (!success && loginSubmitBtn) {
                        loginSubmitBtn.disabled = false;
                        loginSubmitBtn.textContent = 'Login';
                    }
                });
            } else if (loginSubmitBtn) {
                // Fallback: login button only
                loginSubmitBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const usernameField = document.getElementById('loginUsername');
                    const passwordField = document.getElementById('loginPassword');
                    const usernameVal = usernameField ? usernameField.value : '';
                    const passwordVal = passwordField ? passwordField.value : '';

                    loginSubmitBtn.disabled = true;
                    loginSubmitBtn.textContent = 'Logging in...';

                    const success = await performLogin(usernameVal, passwordVal);

                    if (!success) {
                        loginSubmitBtn.disabled = false;
                        loginSubmitBtn.textContent = 'Login';
                    }
                });
            }

            // Open logout confirmation modal (guarded)
            if (logoutBtn) {
                logoutBtn.addEventListener('click', () => {
                    if (logoutConfirmModal) {
                        logoutConfirmModal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    } else {
                        performLogout();
                    }
                });
            }

            // Cancel logout (guarded)
            if (cancelLogout) {
                cancelLogout.addEventListener('click', () => {
                    if (logoutConfirmModal) {
                        logoutConfirmModal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

            if (logoutConfirmModal) {
                logoutConfirmModal.addEventListener('click', (e) => {
                    if (e.target === logoutConfirmModal) {
                        logoutConfirmModal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

            // Confirm logout (guarded)
            if (confirmLogout) {
                confirmLogout.addEventListener('click', async () => {
                    confirmLogout.disabled = true;
                    confirmLogout.textContent = 'Signing out...';
                    await performLogout();
                });
            }
            
            // Initialize carousel
            updateCarousel();
            
            // Load events
            loadEvents();
            
            // Initialize event checking
            checkForTodayEvents();
        });
    </script>
</body>
</html>