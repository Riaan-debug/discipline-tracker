@echo off
title Laravel Queue Worker
echo Starting Laravel Queue Worker...
echo This window will stay open and process emails automatically.
echo Close this window to stop the worker.
echo.
cd /d "%~dp0"
:loop
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
echo Worker stopped. Restarting in 5 seconds...
timeout /t 5 /nobreak >nul
goto loop
