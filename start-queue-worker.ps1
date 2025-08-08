# Laravel Queue Worker Startup Script
# Run this script to start the queue worker for the discipline tracker

Write-Host "Starting Laravel Queue Worker..." -ForegroundColor Green
Write-Host "Press Ctrl+C to stop the worker" -ForegroundColor Yellow
Write-Host ""

try {
    php artisan queue:work --sleep=3 --tries=3 --max-time=3600
}
catch {
    Write-Host "Error starting queue worker: $_" -ForegroundColor Red
}

Write-Host "Queue worker stopped." -ForegroundColor Red
Read-Host "Press Enter to exit"
