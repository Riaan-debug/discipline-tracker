<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Discipline Tracker

This is a Laravel-based web application for managing student incidents and positive reports, sending branded email notifications to parents, and exporting reports (Excel/CSV/PDF).

Mobile app note: As of now, the project no longer targets a mobile application. The `discipline-tracker-mobile/` directory can be archived or removed and is not required for deployment.

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Discipline Tracker

A Laravel-based discipline management system for schools.

## Features

- Student management
- Incident tracking and reporting
- Positive behavior reporting
- Email notifications for critical incidents
- PDF exports
- Audit logging
- Role-based access control

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your environment
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed the database: `php artisan db:seed`

## Queue Worker Setup

This application uses Laravel queues for email processing. You need to run a queue worker to process emails.

### Development (Windows)

**Option 1: PowerShell Script**
```powershell
.\start-queue-worker.ps1
```

**Option 2: Batch File**
```cmd
queue-worker.bat
```

**Option 3: Manual Command**
```bash
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
```

### Production (Linux/Unix)

**Using Supervisor (Recommended)**

1. Install Supervisor:
   ```bash
   sudo apt-get install supervisor
   ```

2. Copy the supervisor configuration:
   ```bash
   sudo cp supervisor.conf /etc/supervisor/conf.d/discipline-tracker.conf
   ```

3. Update Supervisor:
   ```bash
   sudo supervisorctl reread
   sudo supervisorctl update
   sudo supervisorctl start discipline-tracker-worker:*
   ```

**Using Systemd**

Create a systemd service file at `/etc/systemd/system/discipline-tracker-worker.service`:

```ini
[Unit]
Description=Discipline Tracker Queue Worker
After=network.target

[Service]
Type=simple
User=www-data
Group=www-data
WorkingDirectory=/path/to/discipline-tracker
ExecStart=/usr/bin/php artisan queue:work --sleep=3 --tries=3 --max-time=3600
Restart=always
RestartSec=3

[Install]
WantedBy=multi-user.target
```

Then enable and start the service:
```bash
sudo systemctl enable discipline-tracker-worker
sudo systemctl start discipline-tracker-worker
```

## Testing Email Functionality

To test critical incident emails:

```bash
php artisan test:critical-email "Student Name"
```

## Queue Management

- Check queue status: `php artisan queue:work --once`
- Clear failed jobs: `php artisan queue:flush`
- Retry failed jobs: `php artisan queue:retry all`

## Environment Configuration

Make sure your `.env` file includes:

```env
QUEUE_CONNECTION=database
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="School Name"
```

## License

This project is proprietary software.
