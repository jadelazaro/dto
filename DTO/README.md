# DTO Website - PHP Backend Documentation

## Overview
This PHP backend provides a complete content management system for the Digital Transformation Office (DTO) website with admin-only CRUD operations for announcements, news, and calendar events.

## Setup Instructions

### 1. Database Setup
- Copy the `database.sql` file content
- Open phpMyAdmin or your MySQL client
- Create a new database or run the SQL file to create the `dto_database`
- The default admin user is created: 
  - **Username**: admin
  - **Password**: admin123

### 2. Configuration
Update the database credentials in `config.php` if needed:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dto_database');
```

### 3. File Structure
```
/xampp/htdocs/DTO/
├── database.sql              # Database schema
├── config.php                # Database configuration
├── Auth.php                  # Authentication class
├── AnnouncementsCRUD.php     # Announcements management
├── NewsCRUD.php              # News management
├── CalendarEventsCRUD.php    # Calendar events management
├── api/
│   ├── auth.php              # Authentication endpoints
│   ├── announcements.php     # Announcements API
│   ├── news.php              # News API
│   └── events.php            # Calendar events API
├── index.html
├── announcements.html
├── news.html
└── calendar.html
```

---

## API Documentation

### Authentication API
**Base URL**: `/api/auth.php`

#### Login
```
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
    "role": "admin"
  }
}
```

#### Logout
```
POST /api/auth.php?action=logout

Response:
{
  "success": true,
  "message": "Logged out successfully"
}
```

#### Check Login Status
```
GET /api/auth.php?action=status

Response:
{
  "success": true,
  "isLoggedIn": true,
  "isAdmin": true,
  "user": {
    "id": 1,
    "username": "admin",
    "role": "admin"
  }
}
```

#### Create New Admin User
```
POST /api/auth.php?action=create_admin
Content-Type: application/json

{
  "username": "newadmin",
  "email": "newadmin@dto.local",
  "password": "securepassword"
}

Response:
{
  "success": true,
  "message": "Admin user created successfully",
  "user_id": 2
}
```

---

### Announcements API
**Base URL**: `/api/announcements.php`
**Access**: Admin only

#### Get All Announcements
```
GET /api/announcements.php?status=active&limit=50&offset=0

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Announcement Title",
      "content": "Announcement content",
      "category": "Updates",
      "status": "active",
      "featured": false,
      "created_at": "2026-02-03 10:00:00",
      "published_at": "2026-02-03 10:05:00"
    }
  ],
  "count": 1
}
```

#### Get Single Announcement
```
GET /api/announcements.php?action=get&id=1

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Announcement Title",
    ...
  }
}
```

#### Create Announcement
```
POST /api/announcements.php
Content-Type: application/json

{
  "title": "New Announcement",
  "content": "This is the announcement content",
  "category": "Updates",
  "status": "draft"
}

Response:
{
  "success": true,
  "message": "Announcement created successfully",
  "id": 1
}
```

#### Update Announcement
```
PUT /api/announcements.php
Content-Type: application/json

{
  "id": 1,
  "title": "Updated Title",
  "content": "Updated content",
  "status": "active",
  "featured": true
}

Response:
{
  "success": true,
  "message": "Announcement updated successfully"
}
```

#### Delete Announcement
```
DELETE /api/announcements.php
Content-Type: application/json

{
  "id": 1
}

Response:
{
  "success": true,
  "message": "Announcement deleted successfully"
}
```

---

### News API
**Base URL**: `/api/news.php`
**Access**: Admin only

#### Get All News Articles
```
GET /api/news.php?status=active&limit=50&offset=0

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "News Title",
      "content": "Full article content",
      "summary": "Brief summary",
      "category": "Technology",
      "author": "John Doe",
      "featured": false,
      "status": "active",
      "created_at": "2026-02-03 10:00:00",
      "published_at": "2026-02-03 10:05:00"
    }
  ],
  "count": 1
}
```

#### Get Single News Article
```
GET /api/news.php?action=get&id=1

Response:
{
  "success": true,
  "data": { ... }
}
```

#### Create News Article
```
POST /api/news.php
Content-Type: application/json

{
  "title": "Breaking News",
  "content": "Full article content here",
  "summary": "Short summary",
  "category": "Technology",
  "author": "Jane Smith",
  "status": "draft"
}

Response:
{
  "success": true,
  "message": "News article created successfully",
  "id": 1
}
```

#### Update News Article
```
PUT /api/news.php
Content-Type: application/json

{
  "id": 1,
  "title": "Updated News Title",
  "content": "Updated content",
  "status": "active"
}

Response:
{
  "success": true,
  "message": "News article updated successfully"
}
```

#### Delete News Article
```
DELETE /api/news.php
Content-Type: application/json

{
  "id": 1
}

Response:
{
  "success": true,
  "message": "News article deleted successfully"
}
```

---

### Calendar Events API
**Base URL**: `/api/events.php`
**Access**: Admin only

#### Get All Events
```
GET /api/events.php?status=scheduled&startDate=2026-02-01&endDate=2026-02-28&limit=100

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Event Title",
      "description": "Event details",
      "event_date": "2026-02-15",
      "event_time": "10:00:00",
      "end_time": "11:30:00",
      "location": "Conference Room",
      "category": "Meeting",
      "status": "scheduled",
      "created_at": "2026-02-03 10:00:00"
    }
  ],
  "count": 1
}
```

#### Get Events by Month
```
GET /api/events.php?action=month&year=2026&month=02

Response:
{
  "success": true,
  "data": [ ... ],
  "count": 5
}
```

#### Get Single Event
```
GET /api/events.php?action=get&id=1

Response:
{
  "success": true,
  "data": { ... }
}
```

#### Create Event
```
POST /api/events.php
Content-Type: application/json

{
  "title": "Team Meeting",
  "event_date": "2026-02-15",
  "event_time": "10:00",
  "end_time": "11:30",
  "location": "Room 101",
  "category": "Meeting",
  "description": "Q1 Planning Meeting"
}

Response:
{
  "success": true,
  "message": "Calendar event created successfully",
  "id": 1
}
```

#### Update Event
```
PUT /api/events.php
Content-Type: application/json

{
  "id": 1,
  "title": "Rescheduled Meeting",
  "event_date": "2026-02-20",
  "status": "scheduled"
}

Response:
{
  "success": true,
  "message": "Calendar event updated successfully"
}
```

#### Delete Event
```
DELETE /api/events.php
Content-Type: application/json

{
  "id": 1
}

Response:
{
  "success": true,
  "message": "Calendar event deleted successfully"
}
```

---

## Database Schema

### Users Table
- `id` - Primary key
- `username` - Unique username
- `email` - Unique email
- `password_hash` - Bcrypt hashed password
- `role` - enum('admin', 'user')
- `is_active` - Boolean flag
- `created_at`, `updated_at` - Timestamps

### Announcements Table
- `id` - Primary key
- `title` - Announcement title
- `content` - Full content
- `category` - Category
- `status` - enum('active', 'draft', 'archived')
- `featured` - Boolean
- `created_by` - User ID (Foreign Key)
- `created_at`, `updated_at`, `published_at` - Timestamps

### News Table
- `id` - Primary key
- `title` - Article title
- `content` - Full content
- `summary` - Brief summary
- `category` - Category
- `author` - Author name
- `featured_image` - Image path
- `status` - enum('active', 'draft', 'archived')
- `featured` - Boolean
- `created_by` - User ID (Foreign Key)
- `created_at`, `updated_at`, `published_at` - Timestamps

### Calendar Events Table
- `id` - Primary key
- `title` - Event title
- `description` - Event details
- `event_date` - Date (YYYY-MM-DD)
- `event_time` - Time (HH:MM:SS)
- `end_time` - End time
- `location` - Location
- `category` - Category
- `status` - enum('scheduled', 'cancelled', 'completed')
- `created_by` - User ID (Foreign Key)
- `created_at`, `updated_at` - Timestamps

### Activity Logs Table
- Tracks all CRUD operations for audit purposes
- Stores IP address, action, old values, new values

---

## Security Features

1. **Password Hashing**: Uses bcrypt for secure password storage
2. **Session Management**: Secure PHP sessions with timeout
3. **Admin-Only Access**: All CRUD operations require admin login
4. **Audit Trail**: All changes logged with user info, IP address, old/new values
5. **Prepared Statements**: Protection against SQL injection
6. **Input Validation**: Required fields validation
7. **CORS Headers**: Configurable cross-origin access

---

## PHP Classes Reference

### Auth Class
Methods:
- `login($username, $password)` - Authenticate user
- `logout()` - Destroy session
- `isLoggedIn()` - Check if user is logged in
- `isAdmin()` - Check if user is admin
- `getUserId()` - Get current user ID
- `getUserInfo()` - Get current user details
- `requireAdmin()` - Force admin access or die with error
- `createAdmin($username, $email, $password)` - Create new admin user

### AnnouncementsCRUD Class
Methods:
- `create($title, $content, $category, $status)` - Create announcement
- `getAll($status, $limit, $offset)` - Get all announcements
- `getById($id)` - Get single announcement
- `update($id, ...)` - Update announcement
- `delete($id)` - Delete announcement
- `publish($id)` - Publish announcement

### NewsCRUD Class
Methods:
- `create($title, $content, $summary, $category, $author, $status)` - Create article
- `getAll($status, $limit, $offset)` - Get all articles
- `getById($id)` - Get single article
- `update($id, ...)` - Update article
- `delete($id)` - Delete article
- `publish($id)` - Publish article

### CalendarEventsCRUD Class
Methods:
- `create($title, $event_date, $description, ...)` - Create event
- `getAll($status, $startDate, $endDate, $limit, $offset)` - Get all events
- `getByMonth($year, $month)` - Get events by month
- `getById($id)` - Get single event
- `update($id, ...)` - Update event
- `delete($id)` - Delete event

---

## Usage Example - JavaScript/Fetch

### Login
```javascript
async function login() {
  const response = await fetch('/api/auth.php?action=login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({
      username: 'admin',
      password: 'admin123'
    })
  });
  const result = await response.json();
  console.log(result);
}
```

### Create Announcement
```javascript
async function createAnnouncement() {
  const response = await fetch('/api/announcements.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({
      title: 'New Announcement',
      content: 'Content here',
      category: 'Updates',
      status: 'draft'
    })
  });
  const result = await response.json();
  console.log(result);
}
```

### Get All News
```javascript
async function getAllNews() {
  const response = await fetch('/api/news.php?status=active&limit=10', {
    method: 'GET',
    credentials: 'include'
  });
  const result = await response.json();
  console.log(result.data);
}
```

---

## Important Notes

1. **Admin Role Required**: Only logged-in admin users can CREATE, UPDATE, or DELETE content
2. **Credentials**: Change the default admin password immediately after setup
3. **Database Backup**: Regularly backup your `dto_database`
4. **Error Handling**: All endpoints return JSON responses
5. **Sessions**: Sessions are used for authentication - ensure cookies are enabled
6. **Image Uploads**: Featured images for news need to be uploaded separately and paths stored

---

## Support & Troubleshooting

- Ensure XAMPP is running with MySQL enabled
- Check database connection in `config.php`
- Verify file permissions on the server
- Enable error reporting in `config.php` if debugging
- Check activity logs for audit trail of changes
# dto
