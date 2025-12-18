<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the auto-checkout command to run daily at 2 AM
Schedule::command('reservations:auto-checkout')
    ->daily()
    ->at('02:00');
