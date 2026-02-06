# Login & Logout Modal Layout Guide

## Overview
The login and logout modals have been moved to the Contact Us section of the calendar page, providing a cleaner layout and better organization of authentication features.

## Layout Structure

```
┌─────────────────────────────────────────────┐
│              HEADER (STICKY)                 │
│  [DTO Logo]        Navigation Links          │
│              [User Status] [Login/Logout]    │
└─────────────────────────────────────────────┘
                        ▼
┌─────────────────────────────────────────────┐
│           CALENDAR SECTION                   │
│  - Event carousel                           │
│  - Add Event modal                          │
│  - Event Details modal                      │
│  - Delete Confirmation modal                │
│  - Upcoming Events                          │
└─────────────────────────────────────────────┘
                        ▼
┌─────────────────────────────────────────────┐
│      CONTACT & AUTHENTICATION SECTION        │
│  ┌────────────────────────────────────────┐ │
│  │  Left: Contact Information             │ │
│  │  - Phone, Email, Address               │ │
│  │                                        │ │
│  │  Right: Admin Access Box               │ │
│  │  - Login Button                        │ │
│  │  - (or) Logout Button                  │ │
│  │  - (or) User Status Display            │ │
│  └────────────────────────────────────────┘ │
│                                             │
│  ┌─ Login Modal (overlay) ─────────────┐   │
│  │ Admin Login                         │   │
│  │ Username: [_____________]           │   │
│  │ Password: [_____________]           │   │
│  │           [Cancel] [Login]          │   │
│  └─────────────────────────────────────┘   │
│                                             │
│  ┌─ Logout Modal (overlay) ────────────┐   │
│  │         Sign Out?                   │   │
│  │ Are you sure you want to log out?   │   │
│  │    [Cancel]      [Sign Out]         │   │
│  └─────────────────────────────────────┘   │
└─────────────────────────────────────────────┘
                        ▼
┌─────────────────────────────────────────────┐
│          FOOTER                              │
│  - About, Resources, Legal, Connect        │
│  - Copyright                                │
└─────────────────────────────────────────────┘
```

## Components Detail

### Header Authentication (Always Visible)
- **Location**: Top-right of header
- **Shows When NOT Logged In**:
  - User icon + "Guest" text
  - Login button (white background)
- **Shows When Logged In**:
  - User icon + Username + "(Admin)"
  - Logout button (red background)

### Contact & Authentication Section (NEW)
- **Location**: Above footer, below events
- **Layout**: Two-column grid (responsive)
- **Left Column**: Contact Information
  - Phone number
  - Email address
  - Physical address
  - All with icons

- **Right Column**: Admin Access Box (Styled Container)
  - Gradient background (amber to red)
  - Heading: "Admin Access"
  - Description text
  - Dynamic button area
  
### Admin Access Box States

#### When NOT Logged In:
```
┌────────────────────────────┐
│ Admin Access               │
│ Login to access admin...   │
│                            │
│ [🔓 Admin Login] (button) │
└────────────────────────────┘
```

#### When Logged In:
```
┌────────────────────────────┐
│ Admin Access               │
│ Login to access admin...   │
│                            │
│ [🔒 Logout] (button)       │
│                            │
│ ┌──────────────────────┐   │
│ │ Logged in as:        │   │
│ │ john_admin (Admin)    │   │
│ └──────────────────────┘   │
└────────────────────────────┘
```

## Modal Behaviors

### Login Modal
- **Trigger**: Click "Admin Login" button (header or footer)
- **Title**: "Admin Login"
- **Fields**:
  - Username (text input)
  - Password (password input)
  - Error message (conditional)
- **Buttons**:
  - Cancel - closes modal
  - Login - submits form
- **On Success**:
  - Modal closes
  - UI updates
  - Success alert shown
- **On Failure**:
  - Error message displayed in red box
  - User can retry
  - Password field not cleared (user choice)

### Logout Modal
- **Trigger**: Click "Logout" button (header or footer)
- **Title**: "Sign Out?"
- **Message**: Confirmation warning
- **Buttons**:
  - Cancel - closes modal without logout
  - Sign Out - performs logout
- **On Success**:
  - Modal closes
  - UI updates (logout button → login button)
  - Page reloads to clear events
  - Success alert shown

## CSS Classes & Styling

### Admin Access Box Styling
```css
/* Container */
background: linear-gradient(to bottom right, #fef3c7, #fee2e2)
border: 1px solid #fcd34d
border-radius: 0.5rem
padding: 1.5rem

/* Title */
color: #78350f
font-size: 1.5rem
font-weight: bold
margin-bottom: 1rem

/* Description */
color: #374151
margin-bottom: 1.5rem

/* Status Box (when logged in) */
background: white
border: 1px solid #86efac
border-radius: 0.25rem
padding: 1rem
margin-top: 1.5rem
```

### Modal Overlay
```css
position: fixed
top: 0, left: 0, right: 0, bottom: 0
background: rgba(0, 0, 0, 0.5)
z-index: 1000
display: flex
align-items: center
justify-content: center
animation: fadeIn 0.3s
```

### Modal Content
```css
background: white
width: 100%
max-width: 28rem
margin: 1rem
border-radius: 0.5rem
box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1)
animation: slideIn 0.3s
```

## Responsive Behavior

### Desktop (≥768px)
- Two-column layout for Contact & Auth
- Header login button visible
- Footer buttons visible
- Modal centered on screen
- Full width inputs in modal

### Tablet (768px - 480px)
- Two columns (may stack at smallest)
- Smaller padding
- Same modal behavior
- Optimized button spacing

### Mobile (<480px)
- Single column layout
- Stacked contact info
- Full-width buttons
- Modal full viewport minus margins
- Larger touch targets

## JavaScript Integration

### Functions
```javascript
openLoginModal()          // Opens login modal
openLogoutConfirm()       // Opens logout confirmation
performLogin(user, pass)  // Submits login
performLogout()           // Submits logout
checkAuthStatus()         // Checks session on load
updateAuthUI(...)         // Updates all UI elements
```

### Event Listeners
```javascript
loginBtn.addEventListener('click', openLoginModal)
loginBtnFooter.addEventListener('click', openLoginModal)
logoutBtn.addEventListener('click', openLogoutConfirm)
logoutBtnFooter.addEventListener('click', openLogoutConfirm)
loginForm.addEventListener('submit', async (e) => {...})
cancelLogin.addEventListener('click', () => {...})
confirmLogout.addEventListener('click', async () => {...})
```

### State Synchronization
When user logs in or out:
1. Header login button → hidden
2. Header logout button → shown
3. Header user status → updated
4. Footer login button → hidden
5. Footer logout button → shown
6. Footer admin status box → shown
7. All text fields → synchronized

## User Workflows

### Workflow 1: Login from Header
```
1. User scrolls to top
2. Clicks "Login" button (header right)
3. Login modal appears (centered)
4. Fills in credentials
5. Clicks "Login"
6. Success: UI updates, modal closes
7. User can now see logout button
```

### Workflow 2: Login from Contact Section
```
1. User scrolls to bottom (Contact section)
2. Sees "Admin Access" box with login button
3. Clicks "Admin Login"
4. Login modal appears
5. (same as above)
```

### Workflow 3: Logout
```
1. Logged-in user clicks "Logout" (header or footer)
2. Confirmation modal appears
3. "Are you sure?" message shown
4. User clicks "Sign Out"
5. Logout processes, page reloads
6. User back to guest state
```

## Key Features

✅ **Dual Access Points**
- Login available from header AND contact section
- Users choose convenient location

✅ **Clear Visual Hierarchy**
- Contact info on left (informational)
- Login area on right (interactive)
- Color-coded boxes

✅ **Status Awareness**
- Shows current login status
- Username displays when logged in
- Clear buttons for actions

✅ **Mobile Friendly**
- Responsive layout
- Touchable buttons
- Full-screen modals on mobile

✅ **Consistent Experience**
- Same login experience from both buttons
- Same logout flow
- Synchronized UI updates

✅ **Accessible**
- Clear form labels
- Good color contrast
- Keyboard navigation
- Focus management

## Customization Options

### Change Admin Access Box Color
```css
/* Find in calendar.php CSS or edit */
from-amber-50 to-red-50    /* Current gradient */
/* Change to: */
from-blue-50 to-purple-50  /* New colors */
```

### Change Button Colors
```css
/* Login button */
bg-amber-800 hover:bg-amber-700

/* Logout button */
bg-red-600 hover:bg-red-700
```

### Change Section Title
```html
<h2 class="text-3xl font-bold...">Contact Us</h2>
<!-- Change "Contact Us" to your preference -->
```

## Browser Support

| Browser | Support | Notes |
|---------|---------|-------|
| Chrome  | ✅ Full | All features working |
| Firefox | ✅ Full | All features working |
| Safari  | ✅ Full | All features working |
| Edge    | ✅ Full | All features working |
| IE11    | ⚠️ Limited | Modals may need polyfills |

## Testing Checklist

- [ ] Login button in header opens modal
- [ ] Login button in footer opens modal
- [ ] Can type in username field
- [ ] Can type in password field
- [ ] Cancel button closes modal
- [ ] Submit with correct credentials logs in
- [ ] Submit with wrong credentials shows error
- [ ] Logout button hidden when not logged in
- [ ] Logout button shown when logged in
- [ ] Username displays in status area
- [ ] Admin status shows in footer
- [ ] Logout confirmation modal opens
- [ ] Cancel logout closes modal
- [ ] Confirm logout processes logout
- [ ] Page reloads after logout
- [ ] Mobile layout stacks correctly
- [ ] Touch targets are large enough
- [ ] Keyboard Escape closes modals
- [ ] Tab navigation works in form
- [ ] Enter submits form

## Summary

The login and logout modals are now integrated into the Contact & Authentication section at the bottom of the calendar page, providing:

- **Clear location** - Users know where to find login
- **Better organization** - Contact info and auth together
- **Dual access** - Available from header and footer
- **Professional appearance** - Styled admin access box
- **Full responsiveness** - Works on all devices
- **Complete integration** - All buttons synchronized

Users can now easily log in to access admin features directly from the contact section!
