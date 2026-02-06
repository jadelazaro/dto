# DTO System - Complete Integration & Setup Guide

## 📋 Table of Contents
1. [System Architecture](#system-architecture)
2. [File Structure](#file-structure)
3. [Setup Instructions](#setup-instructions)
4. [API Reference](#api-reference)
5. [Workflow Examples](#workflow-examples)
6. [Troubleshooting](#troubleshooting)

---

## System Architecture

### Overview
The DTO Calendar System is built with a **3-tier architecture**:

```
┌─────────────────────────────────────┐
│     PRESENTATION LAYER              │
│  (HTML/CSS/JavaScript Pages)        │
│  - login.php                        │
│  - calendar.php                     │
│  - index.php, announcements.php     │
│  - news.php                         │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│     APPLICATION LAYER               │
│  (PHP Business Logic & APIs)        │
│  - api/auth.php                     │
│  - api/events.php                   │
│  - api/announcements.php            │
│  - api/news.php                     │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│     DATA LAYER                      │
│  (Database Classes & Config)        │
│  - Auth.php (authentication)        │
│  - CalendarEventsCRUD.php           │
│  - AnnouncementsCRUD.php            │
│  - NewsCRUD.php                     │
│  - config.php (DB connection)       │
│  - database.sql (schema)            │
└─────────────────────────────────────┘
```

### Technologies Stack
- **Frontend**: HTML5, Tailwind CSS, Vanilla JavaScript
- **Backend**: PHP 7.4+, MySQLi
- **Database**: MySQL 5.7+
- **Icons**: Lucide Icons (CDN)
- **Security**: Bcrypt (password hashing), Prepared Statements (SQL injection prevention)

---

## File Structure

```
/xampp/htdocs/DTO/
│
├── 📄 Pages (Public & Protected)
│   ├── index.php              ← Homepage
│   ├── login.php              ← Admin login page (NEW)
│   ├── calendar.php           ← Calendar with event management
│   ├── announcements.php      ← Announcements listing
│   ├── news.php               ← News articles listing
│   └── calendar-admin.php     ← Admin event management panel
│
├── 🔧 Core Backend Files
│   ├── config.php             ← Database & app configuration
│   ├── Auth.php               ← Authentication class
│   ├── CalendarEventsCRUD.php ← Calendar event operations
│   ├── AnnouncementsCRUD.php  ← Announcements operations
│   └── NewsCRUD.php           ← News operations
│
├── 📡 API Endpoints
│   └── api/
│       ├── auth.php           ← Login/logout/status endpoints
│       ├── events.php         ← Calendar event CRUD API
│       ├── announcements.php  ← Announcements API
│       └── news.php           ← News API
│
├── 🗄️ Database
│   └── database.sql           ← SQL schema & initial data
│
├── 🎨 Assets
│   ├── DTO outline (1).png    ← Logo
│   ├── DTO PICS(1).jpg        ← Background image
│   └── BANNER DTO updated (2).jpg ← Banner
│
└── 📚 Documentation
    ├── README.md              ← Project overview
    ├── QUICKSTART.md          ← Quick setup guide
    ├── CALENDAR_FUNCTIONS.md  ← Calendar function reference
    ├── CRUD_FORMS_GUIDE.md    ← Form & modal documentation
    ├── INTEGRATION_SETUP.md   ← THIS FILE
    └── FILE_STRUCTURE.md      ← Complete file listing
```

---

## Setup Instructions

### Step 1: Database Setup

1. **Create Database**
   ```sql
   -- Open phpMyAdmin or MySQL command line
   mysql -u root -p
   
   -- Import the schema
   SOURCE /xampp/htdocs/DTO/database.sql;
   ```

2. **Verify Tables Created**
   ```sql
   USE dto_database;
   SHOW TABLES;
   ```
   Expected tables:
   - `users` (admin authentication)
   - `calendar_events` (event management)
   - `announcements` (news feed)
   - `news` (article listing)
   - `activity_logs` (audit trail)

### Step 2: Configuration

1. **Update config.php** (if needed)
   ```php
   define('DB_HOST', 'localhost');    // Usually correct
   define('DB_USER', 'root');          // Match your MySQL user
   define('DB_PASS', '');              // Your MySQL password
   define('DB_NAME', 'dto_database');  // Database name
   ```

2. **Verify Connection**
   - Open `http://localhost/DTO/calendar.php`
   - If you see calendar content, database is connected ✓

### Step 3: Security (IMPORTANT!)

1. **Change Default Admin Password**
   ```php
   // Option A: Via Login
   1. Go to http://localhost/DTO/login.php
   2. Login with: admin / admin123
   3. Access admin panel to change password
   
   // Option B: Via Database
   // In phpMyAdmin, update the password hash:
   UPDATE users SET password_hash = '$2y$10$YOUR_HASH_HERE' WHERE username = 'admin';
   ```

2. **Create bcrypt hash for new password**
   ```php
   <?php
   // Use this script to generate hash
   $password = "yourNewPassword";
   $hash = password_hash($password, PASSWORD_BCRYPT);
   echo $hash;
   ?>
   ```

### Step 4: Test the System

1. **Test Login**
   ```
   URL: http://localhost/DTO/login.php
   User: admin
   Pass: admin123
   Expected: Redirected to calendar.php
   ```

2. **Test Event Creation**
   ```
   1. Login to system
   2. Click "Add Event" on calendar
   3. Fill form and submit
   4. Event should appear on calendar
   ```

3. **Test Admin Panel**
   ```
   URL: http://localhost/DTO/calendar-admin.php
   1. Auto-redirects to login if not authenticated
   2. Shows event management interface after login
   ```

---

## API Reference

### Authentication API (`api/auth.php`)

#### Login
```bash
POST /api/auth.php?action=login
Content-Type: application/json

{
    "username": "admin",
    "password": "admin123"
}

Response:
{
    "success": true,
    "message": "Login successful",
    "user": {
        "id": 1,
        "username": "admin",
        "email": "admin@dto.local",
        "role": "admin"
    }
}
```

#### Check Auth Status
```bash
GET /api/auth.php?action=status
Credentials: include (for cookies)

Response:
{
    "success": true,
    "is_logged_in": true,
    "username": "admin",
    "role": "admin"
}
```

#### Logout
```bash
POST /api/auth.php?action=logout
Credentials: include

Response:
{
    "success": true,
    "message": "Logged out successfully"
}
```

### Calendar Events API (`api/events.php`)

#### Get Events by Month
```bash
GET /api/events.php?action=month&year=2026&month=02
Credentials: include (optional, admin gets all)

Response:
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Team Meeting",
            "event_date": "2026-02-15",
            "event_time": "10:00:00",
            "category": "training",
            "description": "Weekly sync",
            "status": "scheduled"
        }
    ]
}
```

#### Create Event
```bash
POST /api/events.php
Content-Type: application/json
Credentials: include (admin only)

{
    "title": "Q1 Planning",
    "event_date": "2026-02-20",
    "event_time": "14:00:00",
    "end_time": "15:30:00",
    "location": "Conference Room A",
    "category": "strategy",
    "description": "Q1 strategic planning session",
    "status": "scheduled"
}

Response:
{
    "success": true,
    "message": "Event created successfully",
    "id": 5,
    "data": { ...event object... }
}
```

#### Update Event
```bash
PUT /api/events.php
Content-Type: application/json
Credentials: include (admin only)

{
    "id": 5,
    "title": "Q1 Planning - Updated",
    "event_date": "2026-02-21",
    "status": "scheduled"
}

Response:
{
    "success": true,
    "message": "Event updated successfully"
}
```

#### Delete Event
```bash
DELETE /api/events.php
Content-Type: application/json
Credentials: include (admin only)

{
    "id": 5
}

Response:
{
    "success": true,
    "message": "Event deleted successfully"
}
```

---

## Workflow Examples

### Workflow 1: User Browsing Events (No Login)

```
1. User opens http://localhost/DTO/calendar.php
2. Page loads sample events
3. User can:
   - View events
   - Filter by month
   - See event notifications
   - BUT cannot create/edit/delete (requires login)
```

### Workflow 2: Admin Creating Event

```
1. Admin opens http://localhost/DTO/login.php
2. Enters credentials (admin / admin123)
3. Redirected to calendar.php with session
4. Admin clicks "Add Event"
5. Modal form opens
6. Fills all fields and submits
7. Event saved to database via API
8. Event appears on all calendars immediately
9. Admin can later edit/delete via admin panel
```

### Workflow 3: Admin Managing Events

```
1. Admin opens http://localhost/DTO/calendar-admin.php
2. Auto-redirected to login if not authenticated
3. After login, sees admin panel with:
   - All events in table format
   - Month/year filters
   - Edit/Delete buttons
4. Can CRUD events efficiently
```

### Workflow 4: Check Auth Status (JavaScript)

```javascript
// JavaScript code to check if user is logged in
async function checkAuthStatus() {
    const response = await fetch('api/auth.php?action=status', {
        credentials: 'include'
    });
    const data = await response.json();
    
    if (data.is_logged_in) {
        console.log('User logged in as:', data.username);
        updateUIForAdmin();
    } else {
        console.log('Not logged in');
        updateUIForGuest();
    }
}
```

---

## Database Connection Flow

### How It Works

```
1. User accesses page (calendar.php)
2. Page loads config.php
3. config.php creates $mysqli connection
4. Page calls API endpoint if needed
5. API endpoint includes config.php
6. Auth class uses $mysqli to verify user
7. CRUD class uses $mysqli to fetch/save data
8. Response sent back to JavaScript
9. JavaScript updates DOM
```

### Global Variables & Functions

All pages have access to (when config.php is included):

```php
$mysqli              // MySQLi connection object
sendJSON()          // Helper to send JSON responses
escape()            // Helper to escape strings
sanitize()          // Helper to sanitize HTML
logActivity()       // Helper to log actions
```

---

## Session Management

### Session Variables Set After Login

```php
$_SESSION['user_id']      // User ID from database
$_SESSION['username']     // Username
$_SESSION['email']        // Email address
$_SESSION['role']         // 'admin' or 'user'
$_SESSION['login_time']   // Timestamp of login
$_SESSION['ip_address']   // IP address for security
```

### Checking Authorization in Code

```php
// In any page or API endpoint:
require_once 'Auth.php';
$auth = new Auth($mysqli);

// Check if logged in
if ($auth->isLoggedIn()) {
    $username = $auth->getUserId();
}

// Check if admin
if ($auth->isAdmin()) {
    // Admin operations
}

// Require admin (dies if not)
$auth->requireAdmin();
```

---

## Security Features Implemented

### 1. Password Security
- ✅ Bcrypt hashing (cost: 10)
- ✅ `password_verify()` for comparison
- ✅ Minimum 6 character password requirement

### 2. SQL Injection Prevention
- ✅ Prepared statements in all queries
- ✅ Parameter binding with `bind_param()`
- ✅ No direct string concatenation in queries

### 3. Session Security
- ✅ Session timeout configurable
- ✅ IP address logging and verification
- ✅ Session destruction on logout

### 4. Brute Force Protection
- ✅ Login attempt tracking
- ✅ Automatic lockout after 5 attempts
- ✅ 15-minute lockout period

### 5. Access Control
- ✅ Admin checks on sensitive operations
- ✅ 403 Forbidden for unauthorized access
- ✅ Activity logging for audit trail

---

## Troubleshooting

### Problem: "Database connection failed"
**Solution:**
1. Check MySQL is running (`php artisan serve` or XAMPP control panel)
2. Verify `config.php` has correct credentials
3. Ensure database `dto_database` exists
4. Check MySQLi extension is installed: `php -m | grep mysqli`

### Problem: "404 Not Found" on pages
**Solution:**
1. Verify files exist in `/xampp/htdocs/DTO/`
2. Check file names match exactly (case-sensitive on Linux)
3. Ensure directory is accessible: `http://localhost/DTO/`
4. Check htaccess if using rewrites

### Problem: Login not working
**Solution:**
1. Verify database has `users` table
2. Check default admin exists: `SELECT * FROM users WHERE username='admin';`
3. Clear browser cookies and try again
4. Check PHP error log for details
5. Ensure `session_start()` is called in Auth.php

### Problem: Events not saving to database
**Solution:**
1. Verify you're logged in as admin
2. Check `calendar_events` table exists
3. Ensure `created_by` field is set correctly
4. Check database user has INSERT permissions
5. Look for MySQL errors in browser console

### Problem: Logout not working
**Solution:**
1. Ensure `session_destroy()` is called
2. Clear browser cookies
3. Check if JavaScript is blocking navigation
4. Verify `api/auth.php?action=logout` is accessible

### Problem: Permissions denied (403 error)
**Solution:**
1. Check if you're logged in: `http://localhost/DTO/login.php`
2. Verify your user role is 'admin'
3. Check database: `SELECT role FROM users WHERE id = YOUR_ID;`
4. Try creating a new admin user

---

## Performance Optimization Tips

### 1. Database
- ✅ Indexes created on frequently queried columns
- ✅ Use `LIMIT` for event queries
- ✅ Cache frequently accessed data

### 2. Frontend
- ✅ Minify CSS and JavaScript
- ✅ Lazy load images
- ✅ Use browser caching
- ✅ Compress database responses

### 3. API
- ✅ Only return necessary fields
- ✅ Implement pagination for large datasets
- ✅ Use prepared statements (already done)
- ✅ Cache API responses with TTL

### 4. PHP
- ✅ Use persistent database connections
- ✅ Implement output buffering
- ✅ Use opcode caching (OPcache)

---

## Deployment Checklist

- [ ] Change default admin password
- [ ] Update `config.php` with production credentials
- [ ] Enable HTTPS (SSL/TLS)
- [ ] Disable debug mode and detailed errors
- [ ] Set up database backups
- [ ] Configure firewall rules
- [ ] Test all functionality end-to-end
- [ ] Monitor error logs
- [ ] Set up analytics/monitoring
- [ ] Document any custom modifications

---

## Support & Documentation

- **CALENDAR_FUNCTIONS.md** - Detailed function reference
- **CALENDAR_USAGE_GUIDE.md** - Step-by-step usage instructions
- **CRUD_FORMS_GUIDE.md** - Form and modal documentation
- **README.md** - Project overview
- **FILE_STRUCTURE.md** - Complete file listing

For issues, check:
1. PHP error log: `/xampp/logs/php_error.log`
2. MySQL error log
3. Browser console (F12) for JavaScript errors
4. Network tab for API response status

---

## Contact & Maintenance

For questions or issues:
1. Check error logs (PHP and MySQL)
2. Review database schema in `database.sql`
3. Test API endpoints directly with curl
4. Verify all files are in correct locations
5. Ensure PHP version is 7.4+

---

**System Version**: 1.0  
**Last Updated**: February 2026  
**Status**: Production Ready ✓
