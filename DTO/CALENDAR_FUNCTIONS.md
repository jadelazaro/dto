# Calendar Events Management System - Complete Guide

## Overview
The DTO Calendar system now includes comprehensive event management functionality both for public display and admin management.

## Features Implemented

### 1. **Calendar Display (calendar.php)**
- Interactive carousel showing events for August, October, and December 2026
- Add/manage events directly from the calendar interface
- Real-time event notifications for upcoming events
- Today's events highlighting
- Event search and filtering by category

### 2. **Event Management Functions**

#### JavaScript Functions Available in calendar.php:

##### `addEventToDatabase(eventData)`
Saves a new event to the PHP database via API.
```javascript
const result = await addEventToDatabase({
    title: "Team Meeting",
    category: "strategy",
    date: "2026-02-15",
    startTime: "10:00",
    endTime: "11:30",
    description: "Q1 planning meeting"
});
```

##### `updateEventInDatabase(id, eventData)`
Updates an existing event in the database.
```javascript
await updateEventInDatabase(123, {
    title: "Updated Meeting",
    description: "Rescheduled"
});
```

##### `deleteEventFromDatabase(id)`
Deletes an event from the database.
```javascript
await deleteEventFromDatabase(123);
```

##### `fetchEventsFromDatabase(year, month)`
Fetches all events for a specific month from database.
```javascript
const events = await fetchEventsFromDatabase(2026, 2);
```

##### `renderEvent(event)`
Displays an event card on the calendar with all details.
```javascript
renderEvent({
    id: 1,
    title: "Event Title",
    description: "Event details",
    date: "2026-02-15",
    category: "workshop"
});
```

##### `deleteEvent(eventId)`
Deletes an event and removes it from both database and local storage.
```javascript
await deleteEvent('user_1707012345');
```

##### `checkAdminAccess()`
Checks if current user is logged in as admin.
```javascript
const isAdmin = await checkAdminAccess();
if (isAdmin) {
    // Show admin features
}
```

### 3. **Admin Dashboard (calendar-admin.php)**
Dedicated admin panel for managing calendar events:
- Login required
- Create new events
- Edit existing events
- Delete events
- View events by month/year
- Status management (scheduled, completed, cancelled)
- Admin-only access control

## Event Categories
- **Strategy** - Strategic planning and initiatives
- **Training** - Training sessions and workshops
- **Workshop** - Hands-on workshop events
- **Conference** - Large-scale conferences
- **Deadline** - Important deadlines
- **Review** - Review and assessment meetings
- **Ceremony** - Formal ceremonies and events
- **Assessment** - Assessment and evaluation events
- **Planning** - Planning sessions

## How to Add Events

### Method 1: Public Calendar (calendar.php)
1. Click "Add Event" button
2. Fill in event details:
   - Event Title (required)
   - Category (required)
   - Start Date (required)
   - End Date (optional)
   - Start Time (optional)
   - End Time (optional)
   - Description (required)
   - Enable Notification (optional)
3. Click "Add Event"
4. Event saves to local storage and database (if admin logged in)

### Method 2: Admin Panel (calendar-admin.php)
1. Login with admin credentials
2. Click "Add Event"
3. Fill in all event details
4. Select status (scheduled/completed/cancelled)
5. Click "Save Event"
6. Event stored in database

## Database Integration

### Events are stored in the `calendar_events` table with fields:
- `id` - Unique identifier
- `title` - Event title
- `description` - Event details
- `event_date` - Date (YYYY-MM-DD)
- `event_time` - Start time (HH:MM:SS)
- `end_time` - End time
- `location` - Event location
- `category` - Event category
- `status` - scheduled/completed/cancelled
- `created_by` - Admin user ID
- `created_at` - Creation timestamp

## Local Storage
Events are also cached in browser's localStorage for offline access:
- Key: `userCalendarEvents`
- Format: JSON array of event objects
- Persists across page refreshes

## API Endpoints Used

### POST /api/events.php
Create a new event
```json
{
  "title": "Event Name",
  "event_date": "2026-02-15",
  "event_time": "10:00",
  "end_time": "11:30",
  "location": "Room 101",
  "category": "strategy",
  "description": "Event description"
}
```

### PUT /api/events.php
Update an existing event
```json
{
  "id": 123,
  "title": "Updated Title",
  "status": "completed"
}
```

### DELETE /api/events.php
Delete an event
```json
{
  "id": 123
}
```

### GET /api/events.php?action=month&year=2026&month=02
Get events for a specific month

## Event Notifications
- **Today's Events**: Highlighted in red
- **Upcoming Events**: Shows events within next 3 days
- **Notification Badges**: Red badges for events within 7 days
- **Enable/Disable**: Toggle notifications in the calendar controls

## Features Breakdown

### Add Event
- Modal form with validation
- Required fields: Title, Category, Date, Description
- Optional: Time range, end date, notification
- Auto-saves to database if admin
- Falls back to localStorage if not admin

### Delete Event
- Confirmation dialog
- Deletes from database (if DB event)
- Removes from localStorage
- Immediate UI update
- Shows success message

### View Events
- Calendar carousel showing 3 months
- Color-coded by category
- Shows event details on click
- Time and date information
- Status indicators

### Notifications
- Toggle on/off for the session
- Stored in localStorage
- Shows notification badges
- Displays upcoming events list
- Alert for today's events

## Security

### Admin-Only Operations
- All database writes require admin authentication
- Check admin status before allowing modifications
- API enforces admin checks (via Auth class)

### User Events
- Regular users can view all events
- Can add events to calendar (local storage only)
- Can manage their own events

## File Structure
```
/DTO/
├── calendar.php              # Public calendar with event management
├── calendar-admin.php        # Admin dashboard
├── CalendarEventsCRUD.php    # Backend CRUD operations
├── api/events.php            # API endpoints
└── database.sql              # Database schema (calendar_events table)
```

## Example Workflows

### Add Event as User
1. Open calendar.php
2. Click "Add Event"
3. Fill form and submit
4. Event appears in calendar (local)
5. If admin logged in → also saves to database

### Add Event as Admin
1. Open calendar-admin.php
2. Login with admin credentials
3. Click "Add Event"
4. Fill all fields
5. Click "Save Event"
6. Event saved to database
7. Visible to all users on calendar.php

### Delete Event
1. Find event on calendar or admin panel
2. Click delete/trash icon
3. Confirm deletion
4. Event removed from display
5. Removed from database if admin

## Troubleshooting

### Events Not Saving to Database
- Check if user is logged in as admin
- Verify API endpoint is accessible
- Check database connection in config.php
- Events will fall back to localStorage

### Can't See Database Events
- Login as admin first
- Clear browser cache/localStorage
- Refresh page
- Check admin panel to verify events exist

### Notifications Not Working
- Enable notifications in the calendar
- Check localStorage is not disabled
- Events must be within 7 days for badge display
- Today's events always display if notifications enabled

## Future Enhancements
- Event recurring patterns
- Event reminders via email
- Calendar sync with external calendars
- Multiple calendar views (list, grid, week)
- Event attendee management
- Event attachments and files
- Calendar sharing and permissions
