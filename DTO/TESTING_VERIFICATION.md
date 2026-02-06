# DTO System - Verification & Testing Guide

## ✅ Pre-Deployment Verification

Use this checklist to verify all components are working correctly before deployment.

---

## 1. Database Verification

### Test 1.1: Database Connection
```bash
# Test in terminal
mysql -u root -p -h localhost
USE dto_database;
SHOW TABLES;
```

**Expected Output:**
```
+---------------------+
| Tables_in_dto_database |
+---------------------+
| activity_logs       |
| announcements       |
| calendar_events     |
| news                |
| users               |
+---------------------+
```

### Test 1.2: Default Admin User
```sql
SELECT id, username, email, role, is_active FROM users WHERE username='admin';
```

**Expected Output:**
```
| id | username | email           | role  | is_active |
|----|----------|-----------------|-------|-----------|
| 1  | admin    | admin@dto.local | admin | 1         |
```

### Test 1.3: Check Indexes
```sql
SHOW INDEXES FROM calendar_events;
SHOW INDEXES FROM announcements;
```

**Expected Output:** Multiple indexes visible on date fields

---

## 2. Authentication Testing

### Test 2.1: Login with Default Credentials
```
1. URL: http://localhost/DTO/login.php
2. Username: admin
3. Password: admin123
4. Expected: Redirected to calendar.php
5. Check: Session variables set
```

**Verify in browser:**
- [ ] Login form displays
- [ ] Error messages work (try wrong password)
- [ ] Successful login redirects
- [ ] Session persists on page reload

### Test 2.2: Logout Functionality
```
1. Click "Logout" button (if visible)
2. Expected: Redirected to login page
3. Check: Session destroyed
4. Try: Access admin panel → Should redirect to login
```

**Verify:**
- [ ] Logout button visible to admin
- [ ] Logout clears session
- [ ] Cannot access admin panel after logout
- [ ] Cookie cleared

### Test 2.3: Brute Force Protection
```
1. Go to login.php
2. Enter: admin
3. Enter wrong password 5 times
4. Expected: Locked out message
5. Wait: 15 minutes (or clear session)
```

**Verify:**
- [ ] Error message after attempt 1
- [ ] Error message after attempt 5
- [ ] Lockout message appears
- [ ] Can login after wait time

---

## 3. API Endpoint Testing

### Test 3.1: Auth Status Endpoint
```bash
curl -X GET http://localhost/DTO/api/auth.php?action=status \
  -H "Content-Type: application/json" \
  -c /tmp/cookies.txt
```

**Expected Response (not logged in):**
```json
{
  "success": true,
  "is_logged_in": false
}
```

### Test 3.2: Login Endpoint
```bash
curl -X POST http://localhost/DTO/api/auth.php?action=login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"admin123"}' \
  -c /tmp/cookies.txt
```

**Expected Response:**
```json
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

### Test 3.3: Events List Endpoint
```bash
curl -X GET "http://localhost/DTO/api/events.php?action=month&year=2026&month=02" \
  -b /tmp/cookies.txt
```

**Expected Response:**
```json
{
  "success": true,
  "data": [...]
}
```

### Test 3.4: Create Event Endpoint
```bash
curl -X POST http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b /tmp/cookies.txt \
  -d '{
    "title": "Test Event",
    "event_date": "2026-02-15",
    "category": "training",
    "description": "Test"
  }'
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Event created successfully",
  "id": 5
}
```

---

## 4. Frontend Testing

### Test 4.1: Calendar Page Loading
```
1. URL: http://localhost/DTO/calendar.php
2. Expected: Calendar loads with events
3. Check: Three months visible (August, October, December)
4. Verify: Navigation arrows work
```

**Verify:**
- [ ] Page loads without errors
- [ ] Events visible on calendar
- [ ] Month carousel works
- [ ] No console errors (F12)

### Test 4.2: Add Event Modal
```
1. Click "Add Event" button
2. Modal opens with form
3. Fill all required fields:
   - Title: "Test Meeting"
   - Category: "Training"
   - Date: Today
   - Description: "Test description"
4. Submit
5. Expected: Event appears on calendar
```

**Verify:**
- [ ] Modal opens
- [ ] Form fields work
- [ ] Submit disabled while loading
- [ ] Event appears immediately
- [ ] Success message shown

### Test 4.3: Edit Event
```
1. Click on event card
2. Event details modal opens
3. Click "Edit" button
4. Form modal opens with pre-filled data
5. Change title
6. Submit
7. Expected: Event updated
```

**Verify:**
- [ ] Details modal opens
- [ ] Edit button visible (for user events)
- [ ] Form pre-fills correctly
- [ ] Update works
- [ ] Changes reflected on calendar

### Test 4.4: Delete Event
```
1. Click on event card
2. Details modal opens
3. Click "Delete" button
4. Confirmation modal shows
5. Click "Delete Event"
6. Expected: Event removed
```

**Verify:**
- [ ] Delete confirmation modal appears
- [ ] Event removed from calendar
- [ ] Removed from database
- [ ] Cannot undo (as expected)

### Test 4.5: Admin Panel
```
1. URL: http://localhost/DTO/calendar-admin.php
2. Expected: Redirected to login if not authenticated
3. Login: admin/admin123
4. Expected: Admin panel loads
5. Verify: Event table visible
```

**Verify:**
- [ ] Non-authenticated user redirected to login
- [ ] Admin can access
- [ ] Event table displays
- [ ] Filters work (month/year)
- [ ] CRUD buttons functional

---

## 5. Database Operations Testing

### Test 5.1: Event Insertion
```sql
-- After adding an event via UI:
SELECT * FROM calendar_events ORDER BY created_at DESC LIMIT 1;
```

**Expected:** New event visible in table

### Test 5.2: Activity Logging
```sql
SELECT * FROM activity_logs ORDER BY created_at DESC LIMIT 5;
```

**Expected:** Login, create event, update event actions logged

### Test 5.3: User Session Data
```sql
-- Check session data after login:
SHOW PROCESSLIST;
```

**Expected:** Active connection visible

---

## 6. Security Testing

### Test 6.1: SQL Injection Prevention
```
1. Try injecting in login form:
   Username: admin' OR '1'='1
2. Expected: Login fails, error message shown
3. Check: Database not compromised
```

**Verify:**
- [ ] Injection attempt fails safely
- [ ] Generic error message shown
- [ ] No database details exposed

### Test 6.2: XSS Prevention
```
1. Try adding event with XSS payload:
   Title: <script>alert('XSS')</script>
2. Expected: Script not executed
3. Verify: Title appears as plain text
```

**Verify:**
- [ ] Script not executed
- [ ] Malicious content escaped
- [ ] Event still created with sanitized data

### Test 6.3: Authorization Check
```
1. Create user without admin role
2. Try accessing admin-only endpoint
3. Expected: 403 Forbidden error
```

**Verify:**
- [ ] Non-admin cannot create events
- [ ] Non-admin cannot edit events
- [ ] Non-admin cannot delete events

### Test 6.4: Session Expiration
```
1. Login as admin
2. Wait (or manually expire session)
3. Try admin operation
4. Expected: Redirected to login
```

**Verify:**
- [ ] Session expires correctly
- [ ] Auto-redirect to login
- [ ] No data exposed after logout

---

## 7. Performance Testing

### Test 7.1: Page Load Time
```bash
# Using curl with timing:
curl -o /dev/null -s -w '%{time_total}s\n' http://localhost/DTO/calendar.php
```

**Expected:** < 2 seconds

### Test 7.2: Database Query Performance
```sql
-- Check slow queries:
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 0.5;

-- After running queries, check:
SHOW VARIABLES LIKE 'slow_query_log_file';
```

**Expected:** No slow queries

### Test 7.3: API Response Time
```bash
curl -w '@curl_format.txt' -o /dev/null -s http://localhost/DTO/api/events.php
```

**Expected:** < 500ms

---

## 8. Cross-Browser Testing

### Test 8.1: Chrome
```
- [ ] Login page displays correctly
- [ ] Calendar loads and functions
- [ ] Events can be created/edited/deleted
- [ ] Admin panel works
- [ ] No console errors
```

### Test 8.2: Firefox
```
- [ ] Same tests as Chrome
- [ ] LocalStorage works
- [ ] Session cookies set correctly
```

### Test 8.3: Safari
```
- [ ] Same functionality
- [ ] Responsive design works
- [ ] Touch events work (if applicable)
```

### Test 8.4: Mobile Browser
```
- [ ] Login page responsive
- [ ] Calendar readable on mobile
- [ ] Forms usable on small screens
- [ ] Touch navigation works
```

---

## 9. File Integration Testing

### Test 9.1: File Permissions
```bash
# Check file permissions:
ls -la /xampp/htdocs/DTO/
```

**Expected:**
- [ ] All PHP files readable (644 or 755)
- [ ] Database writable (755)
- [ ] Config readable (644, not writable by others)

### Test 9.2: Include Dependencies
```
1. Try accessing each page:
   - http://localhost/DTO/login.php
   - http://localhost/DTO/calendar.php
   - http://localhost/DTO/calendar-admin.php
   - http://localhost/DTO/announcements.php
   - http://localhost/DTO/news.php
2. Expected: All pages load without errors
```

**Verify:**
- [ ] No "undefined function" errors
- [ ] No "class not found" errors
- [ ] No include errors
- [ ] Database connections work

---

## 10. Final Integration Test

### Complete User Journey
```
1. Start at http://localhost/DTO/
   - [ ] Homepage loads
   - [ ] Login link visible

2. Click Login
   - [ ] Login page loads
   - [ ] Form visible

3. Enter credentials
   - [ ] admin / admin123
   - [ ] Click "Sign In"

4. Verify redirect
   - [ ] Redirected to calendar.php
   - [ ] Username displayed in header
   - [ ] Logout button visible

5. Create event
   - [ ] Click "Add Event"
   - [ ] Modal opens
   - [ ] Fill all fields
   - [ ] Submit
   - [ ] Event appears on calendar

6. Edit event
   - [ ] Click event
   - [ ] Details modal opens
   - [ ] Click "Edit"
   - [ ] Update data
   - [ ] Save
   - [ ] Changes reflected

7. Delete event
   - [ ] Click event
   - [ ] Click "Delete"
   - [ ] Confirm deletion
   - [ ] Event removed

8. Check admin panel
   - [ ] Navigate to calendar-admin.php
   - [ ] Event management table visible
   - [ ] Can create/edit/delete from table

9. Logout
   - [ ] Click "Logout"
   - [ ] Confirmation modal
   - [ ] Confirm
   - [ ] Redirected to login
   - [ ] Cannot access admin panel

10. Guest access
    - [ ] Can still view calendar
    - [ ] Cannot create/edit/delete events
    - [ ] Can see sample events
```

**Final Status:**
- [ ] **ALL TESTS PASSED** - System Ready ✓

---

## Troubleshooting During Testing

### If Login Fails
1. Check database: `SELECT * FROM users WHERE username='admin';`
2. Verify password hash: `password_verify('admin123', $hash)`
3. Check error log: `/xampp/logs/php_error.log`
4. Check browser console: F12 → Console tab

### If Events Not Saving
1. Verify logged in: Check session variables
2. Check database permissions: `SHOW GRANTS FOR 'root'@'localhost';`
3. Verify table exists: `SHOW TABLES IN dto_database;`
4. Check error log: `/xampp/logs/php_error.log`

### If Page Loads Blank
1. Check PHP errors: Browser F12
2. Check PHP error log: `/xampp/logs/php_error.log`
3. Verify includes: Check file paths in code
4. Check database connection: Verify config.php

### If API Returns Error
1. Check request method: POST/GET/PUT/DELETE
2. Check headers: Content-Type: application/json
3. Check credentials: Verify user is admin
4. Check error response: Look at JSON message

---

## Performance Benchmarks

Target metrics for production:

| Metric | Target | Actual |
|--------|--------|--------|
| Page Load Time | < 2s | _____ |
| API Response | < 500ms | _____ |
| DB Query Time | < 100ms | _____ |
| Login Time | < 1s | _____ |
| Form Submit | < 2s | _____ |

---

## Sign-Off Checklist

- [ ] All database tests passed
- [ ] All authentication tests passed
- [ ] All API tests passed
- [ ] All frontend tests passed
- [ ] All security tests passed
- [ ] All performance tests passed
- [ ] All browser tests passed
- [ ] Complete user journey verified
- [ ] No errors in logs
- [ ] Documentation reviewed
- [ ] Default password to be changed
- [ ] Ready for deployment

---

**Testing Date:** _______________  
**Tested By:** _________________  
**Result:** ✓ **PASSED / FAILED**

If all checks passed, system is ready for production deployment!
