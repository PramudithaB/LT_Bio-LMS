# Quick Start: Testing OTP Password Reset

## Step 1: Configure Email (Choose One)

### Option A: Gmail (Quick Setup)
Add to your `.env` file:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="LT Bio LMS"
```

### Option B: Mailtrap (Best for Testing)
1. Sign up at https://mailtrap.io (Free)
2. Get credentials from your inbox
3. Add to `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@ltbiolms.com
MAIL_FROM_NAME="LT Bio LMS"
```

## Step 2: Clear Config Cache
```bash
php artisan config:clear
php artisan cache:clear
```

## Step 3: Test the Flow

1. **Go to Forgot Password Page**
   - Visit: `http://your-domain/forgot-password`
   - Or click "Forgot Password" link on login page

2. **Enter Email**
   - Enter a registered user's email
   - Click "Send OTP"
   - Check your email (or Mailtrap inbox)

3. **Verify OTP**
   - Enter the 6-digit code from email
   - Click "Verify OTP"

4. **Reset Password**
   - Enter new password (min 8 characters)
   - Confirm password
   - Click "Reset Password"

5. **Login**
   - Use your email and new password
   - Success! 🎉

## URL Routes

- Forgot Password: `/forgot-password`
- Verify OTP: `/verify-otp`
- Reset Password Form: `/reset-password-form`
- Login: `/login`

## Troubleshooting

### Email not received?
```bash
# Check logs
tail -f storage/logs/laravel.log

# Test email configuration
php artisan tinker
Mail::raw('Test', fn($m) => $m->to('test@example.com')->subject('Test'));
```

### Common Issues

1. **"User not found" error**
   - Make sure the email exists in database
   - Check users table: `SELECT * FROM users;`

2. **OTP expired**
   - OTP is valid for only 10 minutes
   - Request a new OTP

3. **Email sending fails**
   - Verify `.env` email settings
   - Check `storage/logs/laravel.log`
   - Try Mailtrap first for testing

## Database Structure

The migration added these fields to `users` table:
- `otp` (string, 6 digits)
- `otp_expires_at` (timestamp)

## Security Features

✅ OTP expires in 10 minutes
✅ OTP cleared after use
✅ Email validation
✅ Password confirmation required
✅ Rate limiting enabled
✅ Secure password hashing

## Need Help?

See `EMAIL_SETUP.md` for detailed email configuration options.
