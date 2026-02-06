# Login & Logout - Quick Reference

## Where is Login/Logout?

### Option 1: Header (Top Right)
- **Location**: Top-right corner of page
- **Always Visible**: Yes
- **Buttons**:
  - When logged out: "Login" button (white)
  - When logged in: "Logout" button (red)

### Option 2: Contact Section (Bottom)
- **Location**: Scroll to bottom, before footer
- **Section Title**: "Contact & Authentication"
- **Contains**:
  - Contact information (left side)
  - Admin Access box (right side)
  - Login/Logout buttons
  - User status display

**Both options do exactly the same thing and are synchronized!**

## How to Login

### Method 1: Header Button
```
1. Look at top-right of page
2. Click white "Login" button
3. Modal appears with form
4. Enter username: admin
5. Enter password: admin123
6. Click "Login" button
7. Success! You're logged in
```

### Method 2: Contact Section Button
```
1. Scroll down to "Contact & Authentication" section
2. Look at right side: "Admin Access" box
3. Click orange "Admin Login" button
4. Modal appears with form
5. Enter credentials (same as above)
6. Click "Login"
7. Success! You're logged in
```

## How to Logout

### Method 1: Header Logout
```
1. Look at top-right of page
2. Should see your username and red "Logout" button
3. Click "Logout"
4. Confirmation modal appears
5. Click "Sign Out" to confirm
6. Logged out! Page reloads
```

### Method 2: Footer Logout
```
1. Scroll to "Admin Access" box (Contact section)
2. Click red "Logout" button
3. Confirmation modal appears
4. Click "Sign Out" to confirm
5. Logged out! Page reloads
```

## What Shows When Logged In?

### Header
- Shows your username (e.g., "john_admin")
- Shows "(Admin)" label if admin user
- Shows red "Logout" button instead of login

### Contact Section
- Shows red "Logout" button (not login)
- Shows "Logged in as:" status box
- Displays your username
- Can logout from here

## What Shows When Logged Out?

### Header
- Shows "Guest"
- Shows white "Login" button

### Contact Section
- Shows orange "Admin Login" button
- No status box visible
- Can login from here

## Credentials

### Default Admin Account
- **Username**: admin
- **Password**: admin123

⚠️ **Important**: Change these credentials after first login!

## Common Issues

### Problem: Login button not responding
- Ensure JavaScript is enabled
- Try refreshing page
- Check browser console for errors (F12)

### Problem: Login fails with error
- Check username (should be "admin")
- Check password (should be "admin123")
- Ensure database is connected
- Check config.php settings

### Problem: Can't find login button
- **Not logged in?** Look in header top-right
- **Still can't see?** Scroll down to Contact section
- **Mobile?** May be in mobile menu

### Problem: Logout doesn't work
- Click "Sign Out" in confirmation
- Wait for page to reload
- Check if you're already logged out

### Problem: See both login and logout buttons
- This shouldn't happen (contact admin)
- Try refreshing page
- Check browser cache

## Mobile Users

### On Phone/Tablet
- Login button: Header top-right (may be hidden in menu)
- Contact section: Scroll all the way down
- Modals: Will be full-screen friendly
- All buttons: Large and touch-friendly

### Mobile Tips
- Use the Contact section option (easier to access)
- Scroll down past events to find it
- Tap the "Admin Login" button clearly
- Form will expand to fill screen
- Use actual password, not autocomplete

## What You Can Do When Logged In?

✅ Create events (will save to database)
✅ Edit your events
✅ Delete your events
✅ Access admin features
✅ See admin panel (/calendar-admin.php)
✅ Events appear for all users

## What You Can Do When Logged Out?

✅ View events
✅ Create temporary events (local storage only)
✅ See notifications
✅ Browse the website
❌ Admin features disabled
❌ Events won't save to database
❌ No access to admin panel

## Troubleshooting Steps

### If login doesn't work:

**Step 1**: Check credentials
- Username: `admin`
- Password: `admin123`
- Exact match (case-sensitive)

**Step 2**: Check browser
- JavaScript enabled? (needed for login)
- Cookies enabled? (for sessions)
- No browser extensions blocking?

**Step 3**: Check server
- Is database running? (XAMPP MySQL on)
- Is Apache running? (XAMPP Apache on)
- Can you access other pages?

**Step 4**: Clear cache
- Ctrl+Shift+Delete (most browsers)
- Clear cookies and cache
- Close and reopen browser
- Try logging in again

**Step 5**: Check logs
- Press F12 (open developer console)
- Check "Console" tab for errors
- Note any red error messages
- Share with admin/developer

## Security Notes

⚠️ **Remember**:
- Always logout when done
- Don't share credentials
- Change default password
- Use HTTPS in production
- Don't login from public computer

## Getting Help

If you need help:
1. Check error message (if any)
2. Try logging in from different location (header vs footer)
3. Clear browser cache and try again
4. Contact admin with error details
5. Check console logs (F12)

## Summary

**Simple**: Two places to login (header or footer)
**Easy**: Click button, enter credentials, submit
**Safe**: Secure password, session management
**Responsive**: Works on all devices

Login makes your events persistent and gives you admin access!

---

**Default Credentials**:
- Username: `admin`
- Password: `admin123`

**Login Locations**:
1. Header (top-right)
2. Contact section (bottom, before footer)

**Both locations work exactly the same!**
