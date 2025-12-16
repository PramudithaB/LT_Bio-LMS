# Email Configuration Guide for OTP-based Password Reset

## Quick Setup

To enable OTP email functionality, you need to configure your email settings in the `.env` file.

### Option 1: Gmail (Recommended for Testing)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Important for Gmail:**
1. Enable 2-Factor Authentication on your Google account
2. Generate an App Password: https://myaccount.google.com/apppasswords
3. Use the App Password (not your regular password) in `MAIL_PASSWORD`

### Option 2: Mailtrap (For Testing)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@ltbiolms.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Option 3: SendGrid

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-verified-email@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Option 4: Mailgun

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-mailgun-api-key
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Testing Email Configuration

Run this command to test your email setup:

```bash
php artisan tinker
```

Then execute:

```php
Mail::raw('Test email from LT Bio LMS', function ($message) {
    $message->to('your-test-email@example.com')
            ->subject('Test Email');
});
```

## How the OTP System Works

1. User enters email on "Forgot Password" page
2. System generates a 6-digit OTP code
3. OTP is saved to the user's record with 10-minute expiration
4. Email is sent with the OTP code
5. User enters OTP on verification page
6. After successful verification, user can set new password
7. Password is updated and OTP is cleared

## Security Features

- OTP expires after 10 minutes
- OTP is cleared after successful password reset
- Email validation ensures only registered users can request OTP
- Password must be at least 8 characters and confirmed
- Rate limiting on routes prevents abuse

## Troubleshooting

### Email not sending?
1. Check your `.env` configuration
2. Verify your email credentials
3. Check `storage/logs/laravel.log` for errors
4. Test with Mailtrap first for debugging

### Gmail blocking connection?
- Enable "Less secure app access" or use App Password
- Check if 2FA is enabled (required for App Passwords)

### Port issues?
- Try port 465 with SSL encryption
- Try port 587 with TLS encryption
- Check if firewall is blocking SMTP ports

## Production Recommendations

1. Use a dedicated email service (SendGrid, Mailgun, Amazon SES)
2. Set up SPF, DKIM, and DMARC records for your domain
3. Use a professional "from" email address
4. Monitor email delivery rates
5. Implement email queuing for better performance:
   ```php
   Mail::to($user->email)->queue(new OtpMail($otp, $user->name));
   ```

## Files Modified/Created

- Migration: `database/migrations/2025_12_16_125037_add_otp_fields_to_users_table.php`
- Mail Class: `app/Mail/OtpMail.php`
- Email Template: `resources/views/emails/otp.blade.php`
- Controller: `app/Http/Controllers/Auth/PasswordResetLinkController.php`
- Views:
  - `resources/views/auth/forgot-password.blade.php`
  - `resources/views/auth/verify-otp.blade.php`
  - `resources/views/auth/reset-password-otp.blade.php`
- Routes: `routes/auth.php`
- Model: `app/Models/User.php`
