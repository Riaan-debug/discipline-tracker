# Deployment Guide - Vercel

This guide covers deploying the Discipline Tracker application to Vercel.

## Prerequisites

- Vercel account
- GitHub repository connected to Vercel
- PostgreSQL database (Vercel Postgres or external)

## Deployment Steps

### 1. Connect Repository to Vercel

1. Go to [vercel.com](https://vercel.com) and sign in
2. Click "New Project"
3. Import your GitHub repository
4. Select the `discipline-tracker` directory

### 2. Configure Environment Variables

Set these environment variables in your Vercel project:

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=your-laravel-app-key
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
QUEUE_CONNECTION=database
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
LOG_CHANNEL=stack
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@school.edu
MAIL_FROM_NAME=School Discipline Tracker
```

### 3. Deploy

1. Vercel will automatically detect the Laravel configuration
2. The `vercel.json` file handles routing and PHP runtime
3. Deployments happen automatically on git push

### 4. Post-Deployment

1. Run database migrations: `php artisan migrate`
2. Set up your database seeders if needed
3. Configure your domain and SSL

## Notes

- Vercel uses serverless functions, so long-running processes like queue workers may need alternative solutions
- File storage should use cloud storage (S3, etc.) rather than local storage
- Database connections should use connection pooling for better performance

## Support

For issues with Vercel deployment, check the [Vercel documentation](https://vercel.com/docs) and [Laravel deployment guides](https://laravel.com/docs/deployment).





