# Calendar Events - Step-by-Step Usage Guide

## Getting Started

### Setup
1. Database imported with `database.sql`
2. Admin credentials: username `admin`, password `admin123`
3. Files created:
   - `calendar.php` - Public calendar with event management
   - `calendar-admin.php` - Admin panel for events
   - `CalendarEventsCRUD.php` - Backend operations
   - `api/events.php` - API endpoints

## Using the Public Calendar

### Step 1: Access the Calendar
1. Open `http://localhost/DTO/calendar.php`
2. You'll see the events calendar with three months displayed

### Step 2: View Events
1. Scroll through the carousel to see different months
2. Each event shows:
   - Date and month
   - Title
   - Time (if set)
   - Category badge
   - Description on hover
3. Click any event for full details

### Step 3: Add an Event (Public)
1. Click "Add Event" button (top right or floating button)
2. A form modal appears
3. Fill in required fields (marked with *)
   - **Event Title**: Name of the event
   - **Category**: Choose from dropdown (Strategy, Training, etc.)
   - **Start Date**: When the event happens
   - **Description**: Details about the event
4. Optional fields:
   - **End Date**: For multi-day events
   - **Start Time**: Event start time
   - **End Time**: Event end time
5. Check "Enable notification" if you want reminders
6. Click "Add Event"
7. Event appears in calendar (saved to local storage)

### Step 4: Enable Notifications
1. Click "Enable Notifications" button
2. You'll see badges on upcoming events
3. Today's events are highlighted in red
4. Upcoming events (next 3 days) show in the list
5. Click "Clear" to remove all notifications

### Step 5: Delete an Event (Public)
1. Find the event you added
2. Click the trash icon on the event card
3. Confirm the deletion
4. Event is removed immediately

## Using the Admin Panel

### Step 1: Access Admin Panel
1. Open `http://localhost/DTO/calendar-admin.php`
2. You'll be prompted to login if not already logged in

### Step 2: Login
1. Enter admin credentials:
   - Username: `admin`
   - Password: `admin123`
2. Click "Login"
3. You're now in the admin dashboard

### Step 3: View All Events
1. The admin panel shows a table of all events
2. Filter by month and year using dropdown selectors
3. See the following columns:
   - Date
   - Title
   - Category
   - Time
   - Status
   - Actions (Edit/Delete)

### Step 4: Add an Event (Admin)
1. Click "Add Event" button (top right)
2. Modal form appears
3. Fill in all fields:
   - **Title** (required)
   - **Category** (required)
   - **Event Date** (required)
   - **Location** (optional)
   - **Start Time** (optional)
   - **End Time** (optional)
   - **Description** (required)
   - **Status** (scheduled, completed, or cancelled)
4. Click "Save Event"
5. Event is saved to database
6. Visible to all users immediately

### Step 5: Edit an Event (Admin)
1. Find the event in the table
2. Click "Edit" button
3. Form opens with event details
4. Make changes
5. Click "Save Event"
6. Changes saved to database

### Step 6: Delete an Event (Admin)
1. Find the event in the table
2. Click "Delete" button
3. Confirm deletion
4. Event removed from database
5. Removed from all users' calendars

### Step 7: Logout
1. Click "Logout" button (top right)
2. You're redirected to the public calendar

## Common Workflows

### Workflow 1: Create a Team Meeting
1. Admin goes to `calendar-admin.php`
2. Logs in
3. Clicks "Add Event"
4. Fills in:
   - Title: "Q1 Planning Meeting"
   - Category: "Strategy"
   - Date: "2026-02-15"
   - Start Time: "10:00"
   - End Time: "11:30"
   - Description: "Quarterly planning and strategy review"
   - Status: "Scheduled"
5. Saves
6. Event visible to all users on calendar.php

### Workflow 2: Add Personal Reminder
1. User opens `calendar.php`
2. Clicks "Add Event"
3. Fills in:
   - Title: "Project Deadline"
   - Category: "Deadline"
   - Date: "2026-02-28"
   - Description: "Complete project deliverables"
4. Checks "Enable notification"
5. Clicks "Add Event"
6. Event saved locally
7. Gets notification reminder

### Workflow 3: Mark Event as Complete
1. Admin opens `calendar-admin.php`
2. Logs in
3. Navigates to the month with the event
4. Clicks "Edit" on the event
5. Changes Status to "Completed"
6. Saves
7. Event status updated in database

### Workflow 4: Cancel an Event
1. Same as Workflow 3
2. But change Status to "Cancelled"
3. Admin and users see it marked as cancelled

## Event Details Reference

### Event Categories and Meaning

| Category | When to Use |
|----------|------------|
| Strategy | Strategic planning, executive decisions |
| Training | Training sessions, skill development |
| Workshop | Hands-on workshops, practical learning |
| Conference | Large conferences, external events |
| Deadline | Important deadlines, submissions |
| Review | Performance reviews, assessments |
| Ceremony | Formal events, celebrations |
| Assessment | Evaluations, testing events |
| Planning | Planning sessions, brainstorming |

### Event Status Meanings

| Status | Meaning |
|--------|---------|
| Scheduled | Event is planned and will happen |
| Completed | Event has already happened |
| Cancelled | Event was cancelled, won't happen |

## Notification Guide

### How Notifications Work
1. Events within 7 days get a notification badge (red !)
2. Today's events are highlighted in red
3. Next 3 days' events show in "Upcoming Events" list
4. Notifications can be disabled in settings

### Enable/Disable Notifications
1. Click "Enable Notifications" button
2. Toggle switches notification state
3. State saved in browser localStorage
4. Page refreshes to apply changes

### Clear Notifications
1. Click "Clear" button
2. All badges and alerts removed
3. "No upcoming events" message shows

## Tips and Tricks

### Tip 1: Multi-day Events
- Set Start Date and End Date
- Shows as date range on calendar
- Good for conferences or training programs

### Tip 2: All-day Events
- Don't set a Start Time
- Event shows as "All Day Event"
- Useful for holidays or company events

### Tip 3: Event Search
- Use browser find (Ctrl+F) to search event titles
- Filter by category using admin panel dropdowns
- Sort by month/year in admin view

### Tip 4: Event Colors
- Categories have color badges
- Red = Deadline (urgent)
- Green = Strategy/Planning
- Purple = Workshop/Assessment
- Blue = Training/Conference
- Amber = Ceremony

### Tip 5: Keyboard Navigation
- Arrow keys move between months in carousel
- Escape key closes modals
- Tab key navigates form fields

## Troubleshooting

### Problem: Event not appearing on calendar
**Solution:**
1. Check if you're looking at the right month
2. Refresh the page (Ctrl+R)
3. Check browser console for errors (F12)
4. Clear browser cache if needed

### Problem: Can't login to admin panel
**Solution:**
1. Default credentials: admin / admin123
2. Check caps lock on password
3. Clear cookies and try again
4. Check database connection

### Problem: Event not saving to database
**Solution:**
1. Ensure you're logged in as admin
2. Check all required fields are filled
3. Verify database is running (config.php)
4. Event will save to localStorage as fallback

### Problem: Notifications not working
**Solution:**
1. Click "Enable Notifications" button
2. Check localStorage is not disabled
3. Events must be within 7 days for badges
4. Refresh page to see changes

### Problem: Can't delete an event
**Solution:**
1. Confirm you want to delete (check dialog)
2. Admin can delete any event
3. Users can only delete their own events
4. Deleted from both database and display

## Data Persistence

### Events Save In Two Places
1. **Database** (if admin creates them)
   - Persistent across all users
   - Shared globally
   - Requires database connection

2. **LocalStorage** (if regular user creates them)
   - Only in that browser
   - Not shared
   - Works offline

### View Your Data
```javascript
// Check what's in localStorage
JSON.parse(localStorage.getItem('userCalendarEvents'));

// Check notification setting
localStorage.getItem('calendarNotifications');
```

## Advanced: Using the API Directly

### Add Event via API
```bash
curl -X POST http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "API Event",
    "event_date": "2026-02-15",
    "category": "workshop",
    "description": "Created via API"
  }'
```

### Get Events via API
```bash
curl "http://localhost/DTO/api/events.php?action=month&year=2026&month=02"
```

### Delete Event via API
```bash
curl -X DELETE http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{"id": 123}'
```

## Support

For issues or questions:
1. Check CALENDAR_FUNCTIONS.md for detailed documentation
2. Check CALENDAR_API_REFERENCE.md for API details
3. Review README.md for general system info
4. Check browser console (F12) for error messages
5. Verify database connection in config.php
