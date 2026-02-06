# Quick Start Guide - DTO Backend Setup

## Step 1: Import Database
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create new database: `dto_database`
3. Import `database.sql` file into the new database
4. Default admin credentials:
   - Username: **admin**
   - Password: **admin123**

## Step 2: Start Your Server
```bash
# Make sure XAMPP is running with Apache and MySQL enabled
# Or start from command line:
cd C:\xampp
apache_start.bat
mysql_start.bat
```

## Step 3: Test the API

### Login First
```bash
curl -X POST http://localhost/DTO/api/auth.php?action=login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"admin123"}' \
  -c cookies.txt
```

### Create an Announcement
```bash
curl -X POST http://localhost/DTO/api/announcements.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "System Maintenance",
    "content": "The system will be under maintenance on Feb 5, 2026",
    "category": "Maintenance",
    "status": "draft"
  }'
```

### Get All Announcements
```bash
curl -X GET http://localhost/DTO/api/announcements.php?status=active&limit=10 \
  -b cookies.txt
```

### Create a News Article
```bash
curl -X POST http://localhost/DTO/api/news.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "Digital Transformation Initiative",
    "content": "The DTO has launched a new initiative...",
    "summary": "New DT initiative announced",
    "category": "Technology",
    "author": "Admin User",
    "status": "draft"
  }'
```

### Create a Calendar Event
```bash
curl -X POST http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "DTO Monthly Meeting",
    "event_date": "2026-02-10",
    "event_time": "10:00",
    "end_time": "11:30",
    "location": "Main Conference Room",
    "category": "Meeting",
    "description": "Monthly strategy meeting"
  }'
```

### Get Events for February 2026
```bash
curl -X GET http://localhost/DTO/api/events.php?action=month&year=2026&month=02 \
  -b cookies.txt
```

### Update an Announcement (ID 1)
```bash
curl -X PUT http://localhost/DTO/api/announcements.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "id": 1,
    "status": "active",
    "featured": true
  }'
```

### Delete an Announcement (ID 1)
```bash
curl -X DELETE http://localhost/DTO/api/announcements.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{"id": 1}'
```

### Logout
```bash
curl -X POST http://localhost/DTO/api/auth.php?action=logout \
  -b cookies.txt
```

## Step 4: Integrate with Frontend

Add to your HTML head:
```html
<script>
  const API_BASE = 'http://localhost/DTO/api';

  // Check login status
  async function checkAuth() {
    const response = await fetch(`${API_BASE}/auth.php?action=status`, {
      credentials: 'include'
    });
    return await response.json();
  }

  // Login function
  async function adminLogin(username, password) {
    const response = await fetch(`${API_BASE}/auth.php?action=login`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ username, password })
    });
    return await response.json();
  }

  // Get announcements
  async function getAnnouncements(status = null) {
    let url = `${API_BASE}/announcements.php`;
    if (status) url += `?status=${status}`;
    const response = await fetch(url, { credentials: 'include' });
    return await response.json();
  }

  // Get news
  async function getNews(status = null) {
    let url = `${API_BASE}/news.php`;
    if (status) url += `?status=${status}`;
    const response = await fetch(url, { credentials: 'include' });
    return await response.json();
  }

  // Get events by month
  async function getEventsByMonth(year, month) {
    const response = await fetch(
      `${API_BASE}/events.php?action=month&year=${year}&month=${month}`,
      { credentials: 'include' }
    );
    return await response.json();
  }
</script>
```

## File Structure

```
/DTO/
├── database.sql                  # SQL database schema
├── config.php                    # Database configuration
├── Auth.php                      # Authentication class
├── AnnouncementsCRUD.php         # Announcements CRUD
├── NewsCRUD.php                  # News CRUD
├── CalendarEventsCRUD.php        # Calendar events CRUD
├── README.md                     # Full documentation
├── QUICKSTART.md                 # This file
├── api/
│   ├── auth.php                  # Auth API endpoints
│   ├── announcements.php         # Announcements API
│   ├── news.php                  # News API
│   └── events.php                # Calendar events API
├── index.html
├── announcements.html
├── news.html
└── calendar.html
```

## Key Features

✅ **Admin Authentication** - Secure login system with bcrypt hashing
✅ **CRUD Operations** - Create, Read, Update, Delete for all content types
✅ **Role-Based Access** - Admin-only content management
✅ **Audit Trail** - All changes logged with timestamps and user info
✅ **RESTful API** - Standard HTTP methods (GET, POST, PUT, DELETE)
✅ **JSON Responses** - Easy integration with frontend
✅ **Session Management** - Secure PHP sessions
✅ **SQL Injection Protection** - Prepared statements used throughout

## Common Issues & Solutions

### Issue: "Database connection failed"
**Solution**: Check MySQL is running and credentials in `config.php` match your setup

### Issue: "Access denied. Admin privileges required."
**Solution**: Make sure you're logged in as admin. Call login endpoint first.

### Issue: "No fields to update"
**Solution**: Provide at least one field to update in the PUT request

### Issue: CORS errors
**Solution**: API already has CORS headers. If still issues, ensure credentials are included in fetch calls

## Security Reminders

⚠️ **Change default admin password immediately**
⚠️ **Never commit database passwords to version control**
⚠️ **Enable HTTPS in production**
⚠️ **Set proper file permissions on server**
⚠️ **Regularly backup your database**
⚠️ **Monitor activity logs for suspicious actions**

## Next Steps

1. ✅ Import database
2. ✅ Test API endpoints
3. ✅ Create admin panel (HTML form for CRUD operations)
4. ✅ Integrate with frontend
5. ✅ Update your HTML pages to fetch from API
6. ✅ Deploy to production with HTTPS

---

**API Root**: `http://localhost/DTO/api/`
**Database**: `dto_database`
**Default Admin**: admin / admin123

For full documentation, see **README.md**
