<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule monthly summaries to run on the first day of each month at 9:00 AM
Schedule::command('app:send-monthly-summaries')
    ->monthlyOn(1, '09:00')
    ->description('Send monthly student summaries to parents');
