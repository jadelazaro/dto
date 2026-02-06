# CRUD Forms & Modals Guide

## Overview

The calendar system now features a comprehensive CRUD (Create, Read, Update, Delete) modal system for managing events. Each operation has its own dedicated modal interface with intuitive controls and validation.

## Modal Types

### 1. Add/Edit Event Modal

**Purpose**: Create new events or edit existing events

**When It Opens**:
- Click "Add Event" button (top right or floating button)
- Click "Edit" button in event details modal

**Form Fields**:
```
Event Title *              (Required)
Event Category *           (Required - dropdown)
Start Date *               (Required - date picker)
End Date                   (Optional - date picker)
Start Time                 (Optional - time picker)
End Time                   (Optional - time picker)
Event Description *        (Required - textarea)
Enable Notification        (Optional - checkbox)
```

**Categories Available**:
- Strategy - For strategic planning events
- Training - For training sessions
- Workshop - For hands-on workshops
- Conference - For conferences and large events
- Deadline - For important deadlines
- Review - For performance reviews
- Ceremony - For formal events
- Assessment - For evaluations
- Planning - For planning sessions

**Actions**:
- **Submit**: Save event (creates or updates)
- **Cancel**: Close modal without saving
- **X Button**: Close modal without saving

**Success Message**:
- "Event added successfully! (Saved to database)" - Database saved
- "Event added successfully! (Local storage)" - Browser storage saved

**Validation**:
- All required fields must be filled
- Start Date must be valid
- Alert shown if any required field is missing

### 2. Event Details Modal

**Purpose**: View complete event information with options to edit or delete

**When It Opens**:
- Click any event card on the calendar
- Click "View Details" for an event

**Displays**:
```
Event Category         (Colored badge)
Event Title            (Large heading)
Event Date             (Format: Month Day, Year)
Time Range             (If set, otherwise "All Day Event")
Duration               (Calculated from start to end date)
Full Description       (Complete event details)
Location               (If available)
```

**Actions**:
- **Edit Button**: Opens the add/edit modal with event data pre-filled
- **Delete Button**: Opens delete confirmation modal
- **X Button**: Close modal
- **Click Outside**: Close modal

**Features**:
- Read-only display (no inline editing)
- Sample events show view-only (no edit/delete buttons)
- User events show both edit and delete buttons

### 3. Delete Confirmation Modal

**Purpose**: Confirm deletion of an event before removing it

**When It Opens**:
- Click delete icon (trash) on event card
- Click "Delete" button in event details modal

**Displays**:
```
⚠️  Warning Icon
"Delete Event?"
Event Title and Date
"This action cannot be undone. The event will be permanently deleted."
```

**Actions**:
- **Cancel**: Close without deleting
- **Delete Event**: Permanently remove event from database and calendar
- **X or Click Outside**: Close without deleting

**Confirmation**:
- Alert shown after successful deletion: "Event deleted successfully!"
- Event removed from DOM immediately
- Event removed from localStorage
- Event removed from database

### 4. Login Modal (calendar-admin.php)

**Purpose**: Authenticate admin users for accessing the admin panel

**Form Fields**:
```
Username    (text input)
Password    (password input)
```

**Actions**:
- **Login**: Authenticate and enter admin panel
- **Forgot Password**: Shows message to contact admin

**Success**: Redirected to admin dashboard
**Failure**: Error message displayed

---

## Form Fields Reference

### Input Types

#### Text Input (Event Title)
- Accepts: Any text (max 255 characters typically)
- Validation: Required field
- Placeholder: None
- Example: "Q1 Planning Meeting"

#### Date Input
- Format: YYYY-MM-DD
- Validation: Required for start date
- Default: Empty
- Range: Any date supported by browser
- Example: "2026-02-15"

#### Time Input
- Format: HH:MM (24-hour)
- Validation: Optional
- Default: Empty
- Range: 00:00 to 23:59
- Example: "14:30"

#### Textarea (Description)
- Rows: 4 visible lines
- Accepts: Multi-line text with line breaks
- Validation: Required field
- Max Characters: None specified
- Example: "Quarterly planning and strategy review for all departments"

#### Select/Dropdown (Category)
- Options: 9 categories
- Validation: Required field
- Default: "Select Category"
- Example Selection: "workshop"

#### Checkbox (Notification)
- States: Checked or Unchecked
- Default: Unchecked
- Effect: Adds notification badge to event if enabled

---

## Modal Styling & Classes

### Modal Container
```css
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);  /* Dark overlay */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    animation: fadeIn 0.3s ease;
}
```

### Form Container
```css
.event-form {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
    max-width: 42rem;          /* 2xl */
    width: 100%;
    margin: 1rem;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideIn 0.3s ease;
}
```

### Colors Used
- **Primary (Green)**: `#1b5e20` (form backgrounds, borders, buttons)
- **Success**: `#10b981` (save/update buttons)
- **Danger**: `#dc2626` (delete buttons)
- **Neutral**: `#f1f5f9` (backgrounds), `#0f172a` (text)
- **Category Colors**:
  - Strategy: Green (bg-green-100, text-green-800)
  - Training: Blue (bg-blue-100, text-blue-800)
  - Workshop: Purple (bg-purple-100, text-purple-800)
  - Deadline: Red (bg-red-100, text-red-800)
  - Ceremony: Amber (bg-amber-100, text-amber-800)

---

## Keyboard Navigation

### Available Shortcuts
```
Escape          Close modal without saving
Tab             Navigate form fields
Enter           Submit form (when focused on submit button)
Ctrl+Enter      Submit form (when in textarea)
```

### Focus Management
- When modal opens, focus moves to first form field
- Tab key cycles through all interactive elements
- Escape key closes modal

---

## Workflow Examples

### Workflow 1: Create Event
```
1. Click "Add Event" button
2. Modal opens with empty form
3. Fill in required fields:
   - Title: "Team Standup"
   - Category: "Training"
   - Date: Today's date
   - Description: "Daily team synchronization"
4. Click "Add Event"
5. Success message appears
6. Event appears on calendar
7. Modal closes
```

### Workflow 2: View and Edit Event
```
1. Click on any event card
2. Event Details Modal opens
3. Review event information
4. Click "Edit" button
5. Add/Edit Modal opens with form pre-filled
6. Make changes
7. Click "Add Event" to save changes
8. Success message appears
9. Event updates on calendar
```

### Workflow 3: Delete Event
```
1. Click on event card
2. Event Details Modal opens
3. Click "Delete" button
4. Delete Confirmation Modal opens
5. Review event details
6. Click "Delete Event"
7. Confirmation alert shown
8. Event removed from calendar
9. Event removed from database
```

### Workflow 4: Quick Delete
```
1. Hover over event card
2. Click trash icon in bottom-right corner
3. Delete Confirmation Modal opens
4. Click "Delete Event"
5. Event is removed
```

---

## Validation & Error Handling

### Validation Rules

| Field | Rule | Error Message |
|-------|------|---------------|
| Title | Required | "Please fill in all required fields" |
| Category | Required | "Please fill in all required fields" |
| Start Date | Required | "Please fill in all required fields" |
| Description | Required | "Please fill in all required fields" |
| End Date | Must be >= Start Date | (Client validation) |
| Start Time | Valid time format | (HTML5 validation) |
| End Time | Must be > Start Time | (Client validation) |

### Error Messages
- **Missing Required Fields**: "Please fill in all required fields"
- **Database Error**: "Event added successfully! (Local storage)" - Uses fallback
- **Delete Cancelled**: Modal closes without action

### Success Messages
- **Create**: "Event added successfully! (Saved to database)"
- **Create (Fallback)**: "Event added successfully! (Local storage)"
- **Update**: "Event updated successfully!"
- **Delete**: "Event deleted successfully!"

---

## Button States & Feedback

### Submit Button States
```javascript
// Normal state
submitButton.textContent = "Add Event"
submitButton.disabled = false

// Loading state
submitButton.textContent = "Adding..."
submitButton.disabled = true

// After success
submitButton.textContent = "Add Event"
submitButton.disabled = false
```

### Button Interactions
- Hover: Background color changes
- Active: Slightly darker
- Disabled: 50% opacity, not clickable
- Animations: Smooth transition (0.3s ease)

### Visual Feedback
- Modal fade-in animation
- Form slide-in animation
- Button color changes on hover
- Notification badges pulse
- Input focus shows green ring

---

## Mobile Responsiveness

### Desktop View
- Modal max-width: 42rem (672px)
- Form uses 2-column grid for fields
- Full-size buttons side by side
- Overlay covers entire viewport

### Tablet/Mobile View
- Modal max-width: 100% - 2rem margin
- Form uses 1-column layout for fields
- Buttons stack vertically (on smaller screens)
- Overlay fills viewport
- Scrollable if content exceeds screen height

### Breakpoints
```css
/* Desktop */
@media (min-width: 768px) {
    grid-cols-1 md:grid-cols-2  /* 2 columns */
}

/* Tablet/Mobile */
@media (max-width: 768px) {
    grid-cols-1              /* 1 column */
}
```

---

## Data Persistence

### Where Data Saves
1. **Database** (MySQL) - If admin is logged in
   - Persistent across all users
   - Survives browser restart
   - Shared globally
   - Table: `calendar_events`

2. **LocalStorage** (Browser) - If not admin or no database
   - Browser-specific storage
   - Survives page refresh (same browser)
   - Lost if browser data is cleared
   - Lost on different browser/device
   - Key: `userCalendarEvents`

### Data Sync
```javascript
// Add to database
const dbId = await addEventToDatabase(newEvent);

// Fallback to localStorage
if (!dbId) {
    newEvent.id = 'user_' + Date.now();
}

// Always save to localStorage
localStorage.setItem('userCalendarEvents', JSON.stringify(userEvents));
```

### Checking Storage Type
- Database ID: Numeric (123, 456, etc.)
- LocalStorage ID: Text starting with "user_" (user_1234567890)

---

## Troubleshooting

### Problem: Form shows but looks broken
**Solution**:
1. Ensure Tailwind CSS is loaded (check browser console)
2. Verify no CSS conflicts
3. Clear browser cache
4. Reload page (Ctrl+R)

### Problem: Modal won't open
**Solution**:
1. Check if JavaScript errors in console (F12)
2. Verify button IDs match form IDs
3. Check z-index isn't blocked by other elements
4. Ensure `addEventModal` div exists in HTML

### Problem: Form won't submit
**Solution**:
1. Check all required fields are filled (* marked fields)
2. Look for validation errors in console
3. Verify all input IDs are correct
4. Check database connection if not saving to DB

### Problem: Delete doesn't work
**Solution**:
1. Confirm delete modal appeared
2. Check for confirmation popup
3. Verify event ID is valid
4. Check browser console for errors
5. Ensure you have permission to delete

### Problem: Edit modal doesn't pre-fill
**Solution**:
1. Check event data exists in localStorage
2. Verify edit button has onclick handler
3. Look for JavaScript errors in console
4. Refresh page and try again

---

## API Integration

### Create Event API Call
```javascript
async function addEventToDatabase(eventData) {
    const response = await fetch('/DTO/api/events.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
            title: eventData.title,
            event_date: eventData.date,
            category: eventData.category,
            description: eventData.description,
            start_time: eventData.startTime,
            end_time: eventData.endTime,
            notification: eventData.notification ? 1 : 0
        })
    });
    
    const result = await response.json();
    return result.success ? result.data.id : null;
}
```

### Update Event API Call
```javascript
async function updateEventInDatabase(id, eventData) {
    const response = await fetch('/DTO/api/events.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
            id: id,
            title: eventData.title,
            event_date: eventData.date,
            category: eventData.category,
            description: eventData.description,
            start_time: eventData.startTime,
            end_time: eventData.endTime
        })
    });
    
    return await response.json();
}
```

### Delete Event API Call
```javascript
async function deleteEventFromDatabase(id) {
    const response = await fetch('/DTO/api/events.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({ id: id })
    });
    
    const result = await response.json();
    return result.success;
}
```

---

## Advanced: Custom Styling

### Override Modal Width
```css
.event-form {
    max-width: 32rem;  /* Change from 42rem to 32rem */
}
```

### Change Primary Colors
```css
/* Find these in your CSS and modify */
.focus\:ring-green-500 { /* Change green to another color */ }
.bg-green-800 { /* Change button color */ }
.border-green-800 { /* Change border color */ }
```

### Add Custom Animations
```css
@keyframes customFade {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.modal-overlay {
    animation: customFade 0.2s ease;
}
```

---

## Summary

The CRUD modal system provides:
✅ Complete event management (Create, Read, Update, Delete)
✅ User-friendly modal interfaces
✅ Form validation and error handling
✅ Responsive design for all devices
✅ Database and localStorage persistence
✅ Intuitive keyboard navigation
✅ Visual feedback and animations
✅ Mobile-optimized layout

See CALENDAR_USAGE_GUIDE.md for step-by-step workflows.
See CALENDAR_API_REFERENCE.md for API details.
