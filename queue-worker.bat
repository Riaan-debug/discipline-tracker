@echo off
echo Starting Laravel Queue Worker...
echo Press Ctrl+C to stop the worker
echo.
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
pause
