# Calendar Functions Quick Reference

## Core Functions

### JavaScript Functions (calendar.php)

#### Event Management
```javascript
// Add event to database
await addEventToDatabase({
    title: "Event Name",
    category: "strategy",
    date: "2026-02-15",
    startTime: "10:00",
    endTime: "11:30",
    description: "Description"
});

// Update event
await updateEventInDatabase(eventId, {
    title: "Updated Title",
    description: "New description"
});

// Delete event
await deleteEventFromDatabase(eventId);
deleteEvent(eventId); // Local and remote deletion

// Fetch events from database
const events = await fetchEventsFromDatabase(2026, 2);

// Render event on calendar
renderEvent({
    id: 1,
    title: "Event",
    description: "Details",
    date: "2026-02-15",
    category: "workshop"
});
```

#### Helper Functions
```javascript
// Check if user is admin
const isAdmin = await checkAdminAccess();

// Load all events
loadEvents();

// Check for today's events and notifications
checkForTodayEvents();

// Format time for display
formatTime("14:30"); // Returns "2:30 PM"

// Get category styling
getCategoryInfo("strategy"); // Returns category object
```

### PHP Functions (CalendarEventsCRUD.php)

#### CRUD Operations
```php
// Create event
$result = $eventsCrud->create(
    $title,
    $event_date,
    $description,
    $event_time,
    $end_time,
    $location,
    $category
);

// Get all events
$result = $eventsCrud->getAll($status, $limit, $offset);

// Get events by month
$result = $eventsCrud->getByMonth($year, $month);

// Get single event
$result = $eventsCrud->getById($id);

// Update event
$result = $eventsCrud->update($id, $title, $event_date, ...);

// Delete event
$result = $eventsCrud->delete($id);
```

## API Endpoints

### Create Event
```bash
curl -X POST http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "title": "Event",
    "event_date": "2026-02-15",
    "event_time": "10:00",
    "end_time": "11:30",
    "category": "strategy",
    "description": "Details"
  }'
```

### Get Events
```bash
# All events
curl "http://localhost/DTO/api/events.php"

# Events by month
curl "http://localhost/DTO/api/events.php?action=month&year=2026&month=02"

# Single event
curl "http://localhost/DTO/api/events.php?action=get&id=1"
```

### Update Event
```bash
curl -X PUT http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{
    "id": 1,
    "title": "Updated Title",
    "status": "completed"
  }'
```

### Delete Event
```bash
curl -X DELETE http://localhost/DTO/api/events.php \
  -H "Content-Type: application/json" \
  -b cookies.txt \
  -d '{"id": 1}'
```

## Event Object Structure

```javascript
{
  id: 1,
  title: "Event Title",
  description: "Event description",
  date: "2026-02-15",           // YYYY-MM-DD
  endDate: "2026-02-16",        // Optional
  startTime: "10:00",           // HH:MM
  endTime: "11:30",             // HH:MM
  location: "Room 101",         // Optional
  category: "strategy",         // See categories list
  status: "scheduled",          // scheduled/completed/cancelled
  notification: true,           // Boolean
  isSample: false              // Internal flag
}
```

## Event Categories

| Category | Label | Color |
|----------|-------|-------|
| strategy | Strategy | Green |
| training | Training | Blue |
| workshop | Workshop | Purple |
| conference | Conference | Blue |
| deadline | Deadline | Red |
| review | Review | Green |
| ceremony | Ceremony | Amber |
| assessment | Assessment | Purple |
| planning | Planning | Green |

## Common Tasks

### Add Event from Frontend
```javascript
const eventData = {
    title: "Team Meeting",
    category: "strategy",
    date: "2026-02-15",
    startTime: "10:00",
    endTime: "11:30",
    description: "Q1 Planning"
};

const id = await addEventToDatabase(eventData);
if (id) {
    console.log("Event saved with ID:", id);
}
```

### Add Event as Admin
1. Go to calendar-admin.php
2. Login
3. Click "Add Event"
4. Fill form
5. Select status
6. Save

### Display Events
```javascript
// Load all events from database
const events = await fetchEventsFromDatabase(2026, 2);
events.forEach(event => {
    renderEvent(event);
});
```

### Filter Events by Category
```javascript
const workingEvents = events.filter(e => 
    e.category === 'strategy' || e.category === 'planning'
);
```

### Get Upcoming Events
```javascript
const today = new Date();
const upcoming = events.filter(e => {
    const eventDate = new Date(e.date);
    return eventDate >= today && eventDate <= new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);
});
```

## Local Storage Keys

```javascript
// User events stored locally
localStorage.getItem('userCalendarEvents');
localStorage.setItem('userCalendarEvents', JSON.stringify(events));

// Notification settings
localStorage.getItem('calendarNotifications'); // true/false
localStorage.setItem('calendarNotifications', 'true');
```

## Admin Functions

### Login
```javascript
const response = await fetch('api/auth.php?action=login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({
        username: 'admin',
        password: 'password'
    })
});
```

### Check Admin Status
```javascript
const response = await fetch('api/auth.php?action=status', {
    credentials: 'include'
});
const result = await response.json();
console.log(result.isAdmin);
```

### Logout
```javascript
await fetch('api/auth.php?action=logout', {
    method: 'POST',
    credentials: 'include'
});
```

## Database Queries

### Get All Events for a Month
```sql
SELECT * FROM calendar_events 
WHERE YEAR(event_date) = 2026 
AND MONTH(event_date) = 2
ORDER BY event_date ASC;
```

### Get Events by Category
```sql
SELECT * FROM calendar_events 
WHERE category = 'strategy' 
AND status = 'scheduled'
ORDER BY event_date ASC;
```

### Get Upcoming Events
```sql
SELECT * FROM calendar_events 
WHERE event_date >= CURDATE() 
AND event_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
ORDER BY event_date ASC;
```

### Get Events Created by Admin
```sql
SELECT * FROM calendar_events 
WHERE created_by = 1
ORDER BY created_at DESC;
```

## Return Values

All API functions return JSON with this structure:
```json
{
  "success": true/false,
  "message": "Status message",
  "data": null,
  "id": 123
}
```

Error response:
```json
{
  "success": false,
  "message": "Error description"
}
```

## Notes

- All dates use YYYY-MM-DD format
- All times use 24-hour HH:MM:SS format
- Admin authentication required for database writes
- Events without admin access save to localStorage only
- Database events are persistent and shared
- LocalStorage events are browser/device specific
