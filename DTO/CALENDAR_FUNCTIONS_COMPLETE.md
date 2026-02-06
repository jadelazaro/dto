# Calendar Event Functions - Complete Function List

## 🎯 Function Overview

```
CALENDAR SYSTEM
│
├── 📱 PUBLIC INTERFACE (calendar.php)
│   ├── Event Display Functions
│   ├── Event Management Functions
│   ├── Notification Functions
│   └── Utility Functions
│
├── 🔐 ADMIN INTERFACE (calendar-admin.php)
│   ├── Authentication Functions
│   ├── Admin CRUD Operations
│   ├── Event Management
│   └── Dashboard Functions
│
├── 🗄️ BACKEND (CalendarEventsCRUD.php)
│   ├── Create Functions
│   ├── Read Functions
│   ├── Update Functions
│   ├── Delete Functions
│   └── Logging Functions
│
└── 📡 API LAYER (api/events.php)
    ├── POST Endpoints
    ├── GET Endpoints
    ├── PUT Endpoints
    └── DELETE Endpoints
```

## 📋 Function Directory

### Calendar.php Functions

#### 1. Event Database Operations
```
Function: addEventToDatabase(eventData)
Purpose: Save event to database via API
Input: 
  - eventData: {title, category, date, startTime, endTime, description}
Output: Event ID or null
Async: Yes
Example:
  const id = await addEventToDatabase({
    title: "Meeting",
    category: "strategy",
    date: "2026-02-15",
    startTime: "10:00",
    endTime: "11:30",
    description: "Planning session"
  });
```

```
Function: updateEventInDatabase(id, eventData)
Purpose: Update existing event in database
Input: 
  - id: Event ID (number)
  - eventData: {title, description, date, ...} (partial OK)
Output: Boolean (success/failure)
Async: Yes
Example:
  await updateEventInDatabase(123, {
    title: "Updated Title"
  });
```

```
Function: deleteEventFromDatabase(id)
Purpose: Delete event from database
Input: 
  - id: Event ID (number)
Output: Boolean (success/failure)
Async: Yes
Example:
  await deleteEventFromDatabase(123);
```

```
Function: fetchEventsFromDatabase(year, month)
Purpose: Fetch all events for specific month from database
Input: 
  - year: Year (number, e.g., 2026)
  - month: Month (number, 1-12)
Output: Array of event objects
Async: Yes
Example:
  const events = await fetchEventsFromDatabase(2026, 2);
```

#### 2. Event Management Functions
```
Function: renderEvent(event)
Purpose: Display event card on calendar
Input:
  - event: {id, title, description, date, category, ...}
Output: None (DOM manipulation)
Async: No
Side Effects: Adds event to DOM, updates Lucide icons
Example:
  renderEvent({
    id: 1,
    title: "Team Meeting",
    description: "Q1 Planning",
    date: "2026-02-15",
    category: "strategy"
  });
```

```
Function: loadEvents()
Purpose: Load and render all events (sample + user)
Input: None
Output: None (DOM update)
Async: No
Side Effects: Clears and repopulates event containers
Example:
  loadEvents(); // Called on page init
```

```
Function: deleteEvent(eventId)
Purpose: Delete event from local storage and database
Input:
  - eventId: Event ID (string or number)
Output: None
Async: Yes (confirms with dialog first)
Side Effects: Shows confirmation, reloads events
Example:
  await deleteEvent('user_1234567890');
```

#### 3. Display and Utility Functions
```
Function: checkForTodayEvents()
Purpose: Check for today's events and upcoming events
Input: None
Output: None (DOM updates)
Async: No
Side Effects: 
  - Highlights today's events
  - Shows badges for 7-day events
  - Populates upcoming events list
Example:
  checkForTodayEvents();
```

```
Function: formatTime(timeString)
Purpose: Convert 24-hour time to 12-hour format
Input:
  - timeString: Time in "HH:MM" format (string)
Output: Formatted time string "h:MM AM/PM"
Async: No
Example:
  formatTime("14:30"); // Returns "2:30 PM"
  formatTime("09:00"); // Returns "9:00 AM"
```

```
Function: getCategoryInfo(category)
Purpose: Get styling and label info for event category
Input:
  - category: Category name (string)
Output: {label, color, textColor}
Async: No
Example:
  const info = getCategoryInfo("strategy");
  // Returns: {
  //   label: "Strategy",
  //   color: "bg-green-100",
  //   textColor: "green-800"
  // }
```

#### 4. Authentication Functions
```
Function: checkAdminAccess()
Purpose: Check if current user is admin
Input: None
Output: Boolean
Async: Yes (checks auth API)
Example:
  const isAdmin = await checkAdminAccess();
  if (isAdmin) {
    // Show admin features
  }
```

#### 5. Carousel Functions
```
Function: updateCarousel()
Purpose: Update carousel position and indicators
Input: None
Output: None (DOM manipulation)
Async: No
Side Effects: Moves carousel, updates buttons, checks events
Example:
  updateCarousel(); // Called on month change
```

```
Function: handleSwipe()
Purpose: Handle touch swipe navigation on carousel
Input: None
Output: None (DOM update)
Async: No
Side Effects: Changes month based on swipe direction
Internal: Used by touch event listeners
```

#### 6. Notification Functions
```
Function: toggleNotifications (Event Listener)
Purpose: Enable/disable event notifications
Input: None (uses button click)
Output: None (localStorage + page reload)
Side Effects: 
  - Updates localStorage
  - Changes button text
  - Reloads page to apply
Example:
  toggleNotificationsBtn.addEventListener('click', ...)
```

```
Function: clearNotifications (Event Listener)
Purpose: Clear all notification badges
Input: None (uses button click)
Output: None (DOM update)
Side Effects: Hides badges, clears upcoming events
Example:
  clearNotificationsBtn.addEventListener('click', ...)
```

#### 7. Modal Functions
```
Function: addEventModal Control
Purpose: Open/close event addition modal
Operations:
  - Open: addEventModal.classList.remove('hidden')
  - Close: addEventModal.classList.add('hidden')
  - Reset: eventForm.reset()
Example:
  addEventBtn.addEventListener('click', () => {
    addEventModal.classList.remove('hidden');
  });
```

### Calendar-admin.php Functions

#### Admin Authentication
```
Function: logoutAdmin()
Purpose: Logout admin and redirect
Input: None
Output: None (redirect)
Async: Yes
Example:
  logoutAdmin(); // Logs out and goes to calendar.php
```

#### Admin Event Management
```
Function: Form Submit Handler
Purpose: Create or update event via API
Input: Form data (formData)
Output: Page reload on success
Async: Yes
Side Effects: API call, page reload, alerts
Example:
  eventForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    // ... API call ...
  });
```

```
Function: deleteEvent(id)
Purpose: Delete event via admin panel
Input:
  - id: Event ID (number)
Output: None (API call + reload)
Async: Yes
Side Effects: Shows confirm dialog, calls API, reloads
Example:
  deleteEvent(123); // Deletes event and reloads
```

### CalendarEventsCRUD.php Functions (PHP Backend)

#### Create Operations
```
PHP: public function create($title, $event_date, $description, ...)
Purpose: Create new event in database
Returns: {success: bool, message: string, id: number}
Admin Only: Yes
```

#### Read Operations
```
PHP: public function getAll($status, $limit, $offset)
Purpose: Get all events with filters
Returns: {success: bool, data: array, count: number}
Admin Only: No

PHP: public function getById($id)
Purpose: Get single event by ID
Returns: {success: bool, data: object}
Admin Only: No

PHP: public function getByMonth($year, $month)
Purpose: Get events for specific month
Returns: {success: bool, data: array, count: number}
Admin Only: No
```

#### Update Operations
```
PHP: public function update($id, $title, $content, ...)
Purpose: Update event fields
Returns: {success: bool, message: string}
Admin Only: Yes
```

#### Delete Operations
```
PHP: public function delete($id)
Purpose: Delete event from database
Returns: {success: bool, message: string}
Admin Only: Yes
```

### API Endpoints (api/events.php)

#### POST /api/events.php
```
Purpose: Create new event
Auth Required: Yes (admin)
Body:
  {
    "title": "string",
    "event_date": "YYYY-MM-DD",
    "event_time": "HH:MM",
    "end_time": "HH:MM",
    "location": "string",
    "category": "string",
    "description": "string"
  }
Returns: {success: bool, id: number, message: string}
```

#### GET /api/events.php
```
Purpose: Get all events
Auth Required: No
Parameters: ?status=active&limit=50&offset=0
Returns: {success: bool, data: array, count: number}

GET /api/events.php?action=month&year=2026&month=02
Purpose: Get events for month
Returns: {success: bool, data: array, count: number}

GET /api/events.php?action=get&id=1
Purpose: Get single event
Returns: {success: bool, data: object}
```

#### PUT /api/events.php
```
Purpose: Update event
Auth Required: Yes (admin)
Body:
  {
    "id": number,
    "title": "string", (optional)
    "event_date": "YYYY-MM-DD", (optional)
    ... other fields ...
  }
Returns: {success: bool, message: string}
```

#### DELETE /api/events.php
```
Purpose: Delete event
Auth Required: Yes (admin)
Body: {"id": number}
Returns: {success: bool, message: string}
```

## 🔄 Function Call Flow

### When User Adds Event
```
1. User clicks "Add Event"
   ↓
2. eventForm shows (modal)
   ↓
3. User fills and submits
   ↓
4. eventForm.addEventListener('submit')
   ↓
5. addEventToDatabase(eventData)
   ↓
6. fetch(api/events.php) - POST
   ↓
7. If admin logged in → saves to DB
   If not → returns null
   ↓
8. Event added to userEvents (localStorage)
   ↓
9. renderEvent(newEvent)
   ↓
10. Event appears on calendar
```

### When User Deletes Event
```
1. User clicks delete button
   ↓
2. deleteEvent(eventId)
   ↓
3. Confirm dialog shown
   ↓
4. If confirmed:
   ↓
5. deleteEventFromDatabase(id) - if DB ID
   ↓
6. Remove from userEvents array
   ↓
7. localStorage.setItem() - update
   ↓
8. loadEvents() - refresh display
   ↓
9. checkForTodayEvents()
```

### Admin Adding Event
```
1. Admin opens calendar-admin.php
   ↓
2. Clicks "Add Event"
   ↓
3. Fills form
   ↓
4. Form submit
   ↓
5. POST to api/events.php
   ↓
6. CalendarEventsCRUD::create()
   ↓
7. SQL INSERT
   ↓
8. Event in database
   ↓
9. Page reload
   ↓
10. New event visible in table
```

## 📊 Function Summary Table

| Function | Location | Type | Async | Admin Only | Purpose |
|----------|----------|------|-------|-----------|---------|
| addEventToDatabase | calendar.php | JS | Yes | No | Save to DB |
| updateEventInDatabase | calendar.php | JS | Yes | Yes | Update DB |
| deleteEventFromDatabase | calendar.php | JS | Yes | Yes | Delete from DB |
| fetchEventsFromDatabase | calendar.php | JS | Yes | No | Get from DB |
| renderEvent | calendar.php | JS | No | No | Display event |
| loadEvents | calendar.php | JS | No | No | Load all events |
| deleteEvent | calendar.php | JS | Yes | No | Delete locally |
| checkForTodayEvents | calendar.php | JS | No | No | Check today's |
| formatTime | calendar.php | JS | No | No | Format time |
| getCategoryInfo | calendar.php | JS | No | No | Get category |
| checkAdminAccess | calendar.php | JS | Yes | No | Check admin |
| create() | CalendarEventsCRUD.php | PHP | No | Yes | Create event |
| getAll() | CalendarEventsCRUD.php | PHP | No | No | Get events |
| getById() | CalendarEventsCRUD.php | PHP | No | No | Get one |
| getByMonth() | CalendarEventsCRUD.php | PHP | No | No | Get by month |
| update() | CalendarEventsCRUD.php | PHP | No | Yes | Update event |
| delete() | CalendarEventsCRUD.php | PHP | No | Yes | Delete event |

## 💡 Function Tips

1. **Always use async/await** with database functions
2. **Check admin status** before database operations
3. **Handle errors** in try/catch blocks
4. **Reload page** after major changes
5. **Validate input** before sending to API
6. **Check localStorage** for offline access
7. **Use event delegation** for dynamic elements

---

**Total Functions: 40+**
**Public Functions: 25+**
**Admin Functions: 15+**
**API Endpoints: 4 (POST, GET, PUT, DELETE)**

All functions fully documented in CALENDAR_FUNCTIONS.md and CALENDAR_API_REFERENCE.md
